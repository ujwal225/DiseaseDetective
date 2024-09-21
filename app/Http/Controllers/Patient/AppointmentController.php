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
        $endTime = Carbon::parse($schedule->end_time, $timezone);
        $breakStart = Carbon::createFromTime(13, 0, 0, $timezone); // 1:00 PM
        $breakEnd = Carbon::createFromTime(13, 59, 59, $timezone);   // 2:00 PM

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

        // Store the appointment
        Appointment::create([

            $user_id = auth()->id(),
            $patient = Patient::where('user_id', $user_id)->first(),
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
