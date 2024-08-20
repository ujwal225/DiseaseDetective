<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Patient\PatientController;
use App\Models\PatientReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiseasePredictionController extends Controller
{
    public function predict(Request $request)
    {
        // Validate the request
        $request->validate([
            'symptoms' => 'required|array|min:5',
            'symptoms.*' => 'string',
        ]);

        // Get the selected symptoms
        $esymptoms = $request->input('symptoms');

        // Send symptoms to the Python API
        $response = Http::post('http://localhost:5000/predict', [
            'symptoms' => $esymptoms,
        ]);

        // Get the predefined symptoms
        $symptoms = (new PatientController())->preform()->getData()['symptoms'];

        // Check if the response is successful
        if ($response->successful()) {
            $predictedDisease = $response->json()['predicted_disease'];

            // Store the prediction in the patient_report table
            PatientReport::create([
                'patient_id' => auth()->id(),
                'symptoms' => json_encode($esymptoms),
                'predicted_disease' => $predictedDisease,
            ]);


            return redirect()->route('patient.preform')->with('predictedDisease', $predictedDisease)->with('symptoms', $symptoms);
        } else {
            return back()->withErrors(['error' => 'Unable to predict disease.'])->withInput();
        }
    }
}
