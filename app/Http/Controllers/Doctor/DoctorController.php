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
use Illuminate\Support\Facades\View;
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
        $doctorId = $user->doctor->id;
        $isApproved  = $user->doctor->is_approved;

        // Get today's date
        $today = \Carbon\Carbon::today();
        $now = \Carbon\Carbon::now();

        // show appointments where the current time is less than or equal to one hour after the appointment time
        $todayAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'approved')
            ->whereDate('appointment_date', $today)
            ->whereRaw("TIMESTAMP(appointment_date, appointment_time) >= ?", [$now->subHour()])  // Check if the appointment time is still valid within one hour
            ->paginate(2, ['*'], 'todayPage')  // Add 'todayPage' to differentiate pagination
            ->withQueryString();  // Append the query string

        $todayAppointmentCount = $todayAppointments->count();

        return view('doctor.dashboard', compact('userName','isApproved', 'todayAppointmentCount'));
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

        $customMessages = [
            'day_of_week.required' => 'Please select a day of the week.',
            'start_time.required' => 'Start time is required.',
            'start_time.date_format' => 'Start time must be in the format H:i.',
            'end_time.required' => 'End time is required.',
            'end_time.date_format' => 'End time must be in the format H:i.',
            'end_time.after' => 'End time must be after the start time.',
        ];

        $request->validate([
            'day_of_week' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], $customMessages);

        $doctorId = auth()->id();

        // Create new schedule if no existing schedule is found
        $doctor = Doctor::where('user_id', $doctorId)->first();

        // Check if a schedule for the same day already exists
        $existingSchedule = Schedule::where('doctor_id', $doctor->id)
            ->where('day_of_week', $request->day_of_week)
            ->first();

        if ($existingSchedule) {
            // Return back with an error message to the view
            return redirect()->back()->with('error', 'A schedule for this day already exists. Please delete the old schedule to create a new one.');
        }



        Schedule::create([
            'doctor_id' => $doctor->id,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Schedule added successfully.');
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

        return redirect()->back()->with('success', 'Schedule Deleted successfully');

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
        // Get the logged-in doctor's ID
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $doctorId = $user->doctor->id;
        $isApproved = $user->doctor->is_approved;

        // Get today's date
        $today = \Carbon\Carbon::today();
        $now = \Carbon\Carbon::now();

        $oneHourAgo = $now->copy()->subHour(); // Subtract 1 hour from now, without modifying $now

        // Fetch today's appointments that are still valid within one hour after the appointment time
        $todayAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'approved')
            ->whereDate('appointment_date', $now->toDateString()) // Fetch today's appointments
            ->whereRaw("TIMESTAMP(appointment_date, appointment_time) BETWEEN ? AND ?", [$oneHourAgo, $now]) // Appointment is between one hour ago and now
            ->paginate(2, ['*'], 'todayPage')  // Pagination
            ->withQueryString();  // Append the query string

        // Fetch upcoming approved appointments for this doctor
        $upcomingAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'approved')
            ->whereDate('appointment_date', '>', $today)
            ->paginate(2, ['*'], 'upcomingPage')  // Add 'upcomingPage' for upcoming appointments

            ->withQueryString();  // Append the query string

        // Pass data directly to the view
        return view('doctor.view_appointment', [
            'todayAppointments' => $todayAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'isApproved' => $isApproved,
        ]);
    }


    public function viewVerifyToken()
    {
//        // Get the currently authenticated user
//        $userId = auth()->user()->id;
//
//        // Find the user and related doctor
//        $user = User::find($userId);
//        $doctor = $user->doctor;
//
//
//        // Check if the doctor exists and is approved
//        if ($doctor && $doctor->is_approved) {
//            $doctorId = $doctor->id;
//            $isApproved = $user->doctor->is_approved;
//
//            // Fetch tokens related to this doctor through appointments
//            $tokens = Token::whereHas('appointment', function ($query) use ($doctorId) {
//                $query->where('doctor_id', $doctorId);
//            })->where('status', 'active')->paginate(3);
//
//            // Return tokens or pass to a view
//            return view('doctor.verifyToken', ['tokens' => $tokens], compact( 'isApproved'));
//
//        } else {
//            // If the doctor is not approved, redirect or show an error
//            return redirect()->back()->with('error', 'You are not an approved doctor.');
//        }
        // Get the currently authenticated user's ID
        $userId = auth()->user()->id;

        // Find the user and related doctor
        $user = User::find($userId);
        $doctor = $user->doctor;

        // Check if the doctor exists and is approved
        if ($doctor && $doctor->is_approved) {
            $doctorId = $doctor->id;
            $isApproved = $user->doctor->is_approved;

            // Get the current date and time
            $now = now();

            // Fetch tokens related to this doctor through appointments,
            // ensuring the appointment date and time have not passed
            $tokens = Token::whereHas('appointment', function ($query) use ($doctorId, $now) {
                $query->where('doctor_id', $doctorId)
                    ->where(function ($query) use ($now) {
                        // Filter appointments that are either in the future or still valid today
                        $query->where('appointment_date', '>', $now->toDateString())  // Future appointments
                        ->orWhere(function ($query) use ($now) {
                            // For today's appointments, check if the time has not passed yet
                            $query->where('appointment_date', '=', $now->toDateString())
                                ->where('appointment_time', '>=', $now->toTimeString());  // Still valid time
                        });
                    });
            })
                ->where('status', 'active')  // Only fetch active tokens
                ->paginate(3);

            // Return tokens to the view, along with the approval status
            return view('doctor.verifyToken', ['tokens' => $tokens], compact('isApproved'));

        } else {
            // If the doctor is not approved, redirect or show an error
            return redirect()->back()->with('error', 'You are not an approved doctor.');
        }

    }

    public function updateVerifyToken($id)
    {
        // Assuming you have logic to mark the token as used
        $token = Token::findOrFail($id);
        $token->status = 'used'; // Update the token status
        $token->save();

        // Set a success message
        return redirect()->back()->with('success', 'Token marked as used successfully.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
