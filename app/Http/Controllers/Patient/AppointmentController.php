<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showDoctorDetails($doctorId)
    {
        // Fetch doctor details
        $doctor = Doctor::with('user')->findOrFail($doctorId);

        return view('patient.book_appointment', compact('doctor'));
    }
    public function getAvailableSlots($doctorId, $date)
    {
        // Set the default timezone
        $timezone = 'Asia/Kathmandu';
        $dateString = $date ;
        $dateOnly = str_replace('date=', '', $dateString);

        // Get the current date and time in the specified timezone
        $currentDateTime = Carbon::now($timezone);
        $selectedDate = Carbon::parse($dateOnly, $timezone);

        // Convert selected date to day of the week, specifying timezone
        $dayOfWeek =Carbon::parse($dateOnly, 'Asia/Kathmandu')->format('l');

        // Fetch doctor's schedule for the selected day
        $schedule = Schedule::where('doctor_id', $doctorId)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if (!$schedule) {
            return response()->json(['error' => 'Doctor is not available on this date.'], 404);
        }

        // Generate time slots excluding 2 PM to 3 PM (adjust break time as needed)
        $startTime = Carbon::parse($schedule->start_time, $timezone);
        $endTime = Carbon::parse($schedule->end_time, $timezone)->subHour();
        $breakStart = Carbon::createFromTime(13, 0, 0, $timezone); // 1:00 PM
        $breakEnd = Carbon::createFromTime(13, 59, 59, $timezone);   // 2:00 PM

        // If the selected day is today, adjust the start time to the current time
        if ($selectedDate->isToday()) {
            if ($currentDateTime->greaterThan($startTime)) {
                $startTime = $currentDateTime; // Set start time to current time if it's in the past
            }
        }

        $timeSlots = [];
        while ($startTime->lt($endTime)) {
            $formattedTime = $startTime->format('H:i'); // Adjust format if needed

            // Skip break time (2 PM to 3 PM)
            if ($startTime->between($breakStart, $breakEnd)) {
                $startTime->addHour(); // Skip the break
                continue;
            }

            // Check if the time slot is already booked
            $appointmentExists = Appointment::where('doctor_id', $doctorId)
                ->where('appointment_date', $date)
                ->where('appointment_time', $formattedTime)
                ->exists();

            if (!$appointmentExists) {
                $timeSlots[] = $formattedTime; // Add available time slot
            }

            // Increment by 1 hour
            $startTime->addHour();
        }

        return response()->json($timeSlots);
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
        $request->validate([
            'doctor_id' => 'required',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required'
        ]);

        $user_id = auth()->id();
        $patient = Patient::where('user_id', $user_id)->first();

        // Check if user already has an upcoming appointment with the same doctor
        $existingAppointment = Appointment::where('patient_id', $patient->id)
            ->where('doctor_id', $request->doctor_id)
            ->where(function($query) use ($request) {
                $query->where('appointment_date', '>', now()->toDateString())
                    ->orWhere(function($subQuery) use ($request) {
                        $subQuery->where('appointment_date', '=', $request->appointment_date)
                            ->where('appointment_time', '>', now()->format('H:i'));
                    });
            })
            ->first();

        // If there's an existing upcoming appointment, return an error
        if ($existingAppointment) {
            return redirect()->back()->withErrors('You already have an appointment with this doctor. Please wait until your current appointment is completed or expired.');
        }

        // Store the new appointment if no existing appointment
        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Appointment booked successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
