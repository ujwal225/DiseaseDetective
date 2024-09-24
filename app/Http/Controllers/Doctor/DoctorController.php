<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\PatientReport;
use App\Models\Schedule;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DoctorController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function homePage()
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $userName = $user->first_name;
        $isApproved  = $user->doctor->is_approved;
        return view('doctor.dashboard', compact('userName','isApproved'));
    }

    public function profile()
    {
        $userId = auth()->id();
        $user = User::find($userId);
//        $userName = $user->first_name;
        $isApproved  = $user->doctor->is_approved;
        return view('doctor.profile', compact('user','isApproved'));
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
        return view('doctor.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'specialization' => 'nullable|string',
            'profilepic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'experience' => 'nullable|integer|min:0|max:30',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Update user information
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->doctor->phone = $request->phone;
        $user->doctor->specialization = $request->specialization;
        $user->doctor->experience = $request->experience;
        $user->doctor->location = $request->location;
        $user->doctor->description = $request->description;

        // Handle profile picture upload
        if ($request->hasFile('profilepic')) {
            $profilePic = $request->file('profilepic');
            $profilePicName = time() . '_' . $profilePic->getClientOriginalName(); // Use a unique name
            $profilePic->move('images/profile_pics/', $profilePicName);
            $user->doctor->profilepic = 'images/profile_pics/' . $profilePicName; // Store the path
        }

        // Handle certificate upload
        if ($request->hasFile('certificate')) {
            $certificate = $request->file('certificate');
            $certificateName = time() . '_' . $certificate->getClientOriginalName(); // Use a unique name
            $certificate->move('images/certificates/', $certificateName);
            $user->doctor->certificate = 'images/certificates/' . $certificateName; // Store the path
        }

        // Save the doctor information
        $user->doctor->save();
        // Save the user information
        $user->save();

        // Redirect back with a success message
        return redirect()->route('doctor.dashboard', $user->id)
            ->with('success', 'Profile updated successfully!');
    }


    public function schedule(Request $request)
    {
        $request->validate([
            'day_of_week' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $doctorId = auth()->id();


        // Delete old schedule for the specified day of the week
        Schedule::where('doctor_id', $doctorId)
            ->where('day_of_week', $request->day_of_week)
            ->delete();


        Schedule::create([
            $user_id = auth()->id(),
            $doctor = Doctor::where('user_id', $user_id)->first(),
            'doctor_id' => $doctor->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,

        ]);

        return redirect()->back()->with('success', 'Schedule added successfully');
    }



    public function scheduleIndex()
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $userName = $user->first_name;
        $isApproved  = $user->doctor->is_approved;
        $doctorId = $user->doctor->id;
        $schedules = Schedule::where('doctor_id', $doctorId)
            ->orderByRaw("FIELD(day_of_week, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
            ->get();
        return view('doctor.schedule', compact('userName','isApproved', 'schedules'));
    }

    public function scheduleDelete(string $id)
    {
        // Find the schedule by ID
        $schedule = Schedule::findOrFail($id);

        // Delete the schedule
        $schedule->delete();

        return redirect()->back()->with('success', 'Schedule added successfully');

    }

    public function manageAppointmentsIndex()
    {
        // Get the authenticated doctor's user ID
        $userId = auth()->id();
        $user = User::find($userId);
        $doctorId = $user->doctor->id;
        $isApproved  = $user->doctor->is_approved;

        // Fetch requested appointments for the specific doctor
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'pending') // Assuming 'requested' is the status for requested appointments
            ->with('patient') // Eager load the patient relationship for better performance
            ->get();

        // Return a view with the appointments data
        return view('doctor.manageAppointment', compact('appointments', 'isApproved'));

    }

    public function appointmentDetails(string $id)
    {
        $appointment = Appointment::with('patient.user')->findOrFail($id);

        $userId = auth()->id();
        $user = User::find($userId);
        $isApproved = $user->doctor->is_approved;

        // Fetch the latest patient report for the patient associated with the appointment
        $patientReports = PatientReport::where('patient_id', $appointment->patient->id)
            ->where('created_at', '<=', $appointment->created_at) // Only reports created before the appointment
            ->orderBy('created_at', 'desc')
            ->take(1) // Only get the latest report
            ->get();

        return view('doctor.appointment_details', compact('appointment', 'isApproved', 'patientReports'));
    }

    public function approveAppointment($id)
    {
        // Find the appointment by its ID
        $appointment = Appointment::findOrFail($id);

//        // Check if the authenticated user is the doctor for this appointment
//        $userId = auth()->id();
//        if ($appointment->doctor_id !== $userId) {
//            return response()->json(['error' => 'Unauthorized'], 403);
//        }

        // Update the appointment status to 'approved'
        $appointment->status = 'approved';
        $appointment->save();

        $tokenNumber = strtoupper(Str::random(10));

        Token::create([
            'appointment_id' => $appointment->id,
            'token_number' => $tokenNumber,
            'status' => 'active', // or any status you want to set
        ]);


        // Optionally, you can return a success message or redirect
        return redirect()->route('doctor.manageAppointment')->with('success', 'Appointment approved successfully.');
    }

    public function appointmentIndex()
    {
        // Assuming the doctor is logged in, get the doctor's ID
        $userId = auth()->user()->id;


        $user = User::find($userId );
        $doctorId = $user->doctor->id;
        $isApproved = $user->doctor->is_approved;

        // Get today's date
        $today = \Carbon\Carbon::today();

        // Fetch today's approved appointments for this doctor
        $todayAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'approved')
            ->whereDate('appointment_date', $today)
            ->get();

        $todayAppointmentCount = $todayAppointments->count();
        view()->share('todaysAppointmentCount', $todayAppointmentCount);

        // Fetch upcoming approved appointments for this doctor
        $upcomingAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'approved')
            ->whereDate('appointment_date', '>', $today)
            ->get();

        // Return view with both today's and upcoming appointments
        return view('doctor.view_appointment', [
            'todaysAppointments' => $todayAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'isApproved' => $isApproved,

        ]);

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
