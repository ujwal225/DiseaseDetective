<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Patient\PatientController;
use App\Models\PatientReport;
use App\Models\Doctor; // Import the Doctor model
use App\Models\User;
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

        // Disease specialization mapping
        $diseaseSpecializations = [

                'Common Cold' => 'General Physician',
                'Flu' => 'General Physician',
                'COVID-19' => 'Infectious Disease Specialist',
                'Strep Throat' => 'Otolaryngologist (ENT)',
                'Pneumonia' => 'Pulmonologist',
                'Gastroenteritis' => 'Gastroenterologist',
                'Migraine' => 'Neurologist',
                'Chickenpox' => 'Dermatologist',
                'Malaria' => 'Infectious Disease Specialist',
                'Tuberculosis' => 'Pulmonologist',
                'Dengue' => 'Infectious Disease Specialist',
                'Typhoid' => 'Infectious Disease Specialist',
                'Bronchitis' => 'Pulmonologist',
                'Sinusitis' => 'Otolaryngologist (ENT)',

        ];

        // Check if the response is successful
        if ($response->successful()) {
            $predictedDisease = $response->json()['predicted_disease'];

            // Get the specialization for the predicted disease
            $specialization = $diseaseSpecializations[$predictedDisease] ?? 'General Physician';

            // Fetch doctors associated with the obtained specialization
            $doctors = Doctor::where('specialization', $specialization)
                ->where('is_approved', 1) // Ensure only approved doctors are fetched
                ->get();

            // Store the prediction in the patient_report table
            PatientReport::create([
                $userId = auth()->id(),
            $patientId = User::findOrFail($userId)->patient->id,
                'patient_id' => $patientId,
                'symptoms' => json_encode($esymptoms),
                'predicted_disease' => $predictedDisease,
            ]);

            // Redirect with the predicted disease, specialization, symptoms, and doctors
            return redirect()->route('patient.preform')
                ->with('predictedDisease', $predictedDisease)
                ->with('symptoms', $symptoms)
                ->with('doctors', $doctors);

        } else {
            return back()->withErrors(['error' => 'Unable to predict disease.'])->withInput();
        }

    }
}
