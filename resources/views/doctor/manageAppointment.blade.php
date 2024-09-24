@extends('layouts.doctor_master')

@section('title','manageAppointment')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-6">Pending Appointments</h2>

        @if ($appointments->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">No Pending Appointments!</strong>
                <span class="block sm:inline">You currently have no pending appointments.</span>
            </div>
        @else
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">Patient Name</th>
                    <th class="py-2 px-4 border-b">Appointment Date</th>
                    <th class="py-2 px-4 border-b">Appointment Time</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">{{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}</td> <!-- Adjust according to your Patient model -->
                        <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</td>
                        <td class="py-2 px-4 border-b">{{ $appointment->appointment_time }}</td>
                        <td class="py-2 px-4 border-b">{{ ucfirst($appointment->status) }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('doctor.appointment_details', $appointment->id) }}" class="text-blue-600 hover:underline">View</a>
                            <!-- Add more actions like approve, reject etc. if needed -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
