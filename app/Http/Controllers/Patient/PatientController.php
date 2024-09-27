<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\PatientReport;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function homePage()
    {
        return view('patient.dashboard');
    }

    public function profile()
    {
        $userId = auth()->id();
        $user = User::find($userId);
        return view('patient.profile', compact('user'));
    }



    public function preform()
    {

        $symptoms = [
            "Fatigue", "Headache", "Congestion", "Cough", "Sneezing", "Mild Fever",
            "Runny Nose", "Sore Throat", "Chills", "Muscle Aches", "High Fever",
            "Shortness of Breath", "Loss of Taste", "Dry Cough", "Nausea", "Red Tonsils",
            "Painful Swallowing", "Swollen Lymph Nodes", "Chest Pain", "Sweating",
            "Abdominal Pain", "Diarrhea", "Vomiting", "Sensitivity to Light", "Dizziness",
            "Sensitivity to Sound", "Blurred Vision", "Itchy Rash", "Loss of Appetite",
            "Sweats", "Persistent Cough", "Weight Loss", "Night Sweats", "Skin Rash",
            "Pain Behind Eyes", "Joint Pain", "Stomach Pain", "Weakness", "Mucus Production",
            "Chest Discomfort", "Nasal Congestion", "Facial Pain"
        ];
        return view('patient.preform',compact('symptoms'));
    }

    public function showAppointment()
    {
        $user = auth()->user();
        $patient = $user->patient;

        // Get the current date and time
        $currentDateTime = now();
        $oneHourLater = $currentDateTime->copy()->addHour();

        // Fetch appointments that are not expired or outdated
        $appointments = Appointment::where('patient_id', $patient->id)
            ->where(function ($query) use ($currentDateTime, $oneHourLater) {
                $query->where('appointment_date', '>', $currentDateTime->toDateString()) // Future appointments
                ->orWhere(function ($query) use ($currentDateTime, $oneHourLater) {
                    $query->where('appointment_date', '=', $currentDateTime->toDateString()) // Today's appointments
                    ->where('appointment_time', '>=', $currentDateTime->toTimeString()) // After the current time
                    ->where('appointment_time', '<=', $oneHourLater->toTimeString()); // Within one hour
                });
            })
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(5);

        return view('patient.reqAppointment', compact('appointments'));
    }




    public function showToken($appointment_id)
    {
        $token = Token::where('appointment_id', $appointment_id)->with('appointment')->first();

        return view('patient.viewToken', compact('token'));
    }

    public function showHistoryAppointment()
    {
        // Get the currently authenticated user's ID
        $userId = auth()->user()->id;

        $patient = Patient::where('user_id', $userId)->first();

        // Fetch outdated appointments for the authenticated patient
        $appointments = Appointment::where('patient_id', $patient->id)
            ->where('appointment_date', '<', now())
            ->with('token')
            ->orderBy('appointment_date', 'desc')
            ->paginate(5);

        // Loop through appointments to fetch the latest patient report for each
        foreach ($appointments as $appointment) {
            $latestReport = PatientReport::where('patient_id', $appointment->patient->id)
                ->where('created_at', '<=', $appointment->created_at) // Only reports created before the appointment
                ->orderBy('created_at', 'desc')
                ->first(); // Get the latest report

            // Add disease to appointment object
            $appointment->disease = $latestReport ? $latestReport->predicted_disease : null;
        }


        return view('patient.historyAppointment', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = auth()->user(); // Assuming the user is authenticated
        return view('patient.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'gender' => 'nullable|string|in:male,female,other',
        ]);

        // Find the patient user
        $user = User::findOrFail($id);

        // Update user information
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        // Update patient-specific information
        $user->patient->date_of_birth = $request->date_of_birth;
        $user->patient->address = $request->address;
        $user->patient->gender = $request->gender;

        // Save the patient and user information
        $user->patient->save();
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::find($id);
        if($appointment->delete()){
            request()->session()->flash('success', 'appointment deleted successfully.');
        }else{
            request()->session()->flash('error', 'appointment deletion failed.');
        }

        return redirect()->route('patient.reqAppointment');
    }
}
