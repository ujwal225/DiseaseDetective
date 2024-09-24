@extends('layouts.doctor_master')

@section('title', 'View Appointments')

@section('content')

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">Today's Appointments</h1>

        @if($todaysAppointments->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                <p>No appointments for today.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Patient Name</th>
                        <th class="py-3 px-6 text-left">Time</th>
                        <th class="py-3 px-6 text-left">Status</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($todaysAppointments as $appointment)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <span class="font-medium">{{ $appointment->patient->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $appointment->appointment_time }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $appointment->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <h1 class="text-2xl font-semibold text-gray-800 mt-12 mb-6 border-b pb-2">Upcoming Appointments</h1>

        @if($upcomingAppointments->isEmpty())
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                <p>No upcoming appointments.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Patient Name</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-left">Time</th>
                        <th class="py-3 px-6 text-left">Status</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($upcomingAppointments as $appointment)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <span class="font-medium">{{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $appointment->appointment_date }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <span>{{ $appointment->appointment_time }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $appointment->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800' }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
