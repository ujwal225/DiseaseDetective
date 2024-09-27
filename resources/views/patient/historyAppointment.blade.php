@extends('layouts.patient_master')

@section('title', 'Appointment History')

@section('content')
    <div class="overflow-x-auto">
        @if($appointments->isEmpty())
            <div class="text-center p-4 bg-gray-200 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold text-gray-700">No Past Appointments</h2>
                <p class="text-gray-600">You have no past appointments recorded.</p>
            </div>
        @else
            <table class="min-w-full mt-6 bg-white rounded-lg shadow-md">
                <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 text-left text-gray-700">Doctor Name</th>
                    <th class="py-2 px-4 text-left text-gray-700">Appointment Date</th>
                    <th class="py-2 px-4 text-left text-gray-700">Appointment Time</th>
                    <th class="py-2 px-4 text-left text-gray-700">Disease</th>
                    <th class="py-2 px-4 text-left text-gray-700">Status</th>
                    <th class="py-2 px-4 text-left text-gray-700">Action</th> <!-- New column for actions -->
                </tr>
                </thead>
                <tbody>
                @foreach($appointments as $appointment)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y')}}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                        <td class="py-3 px-4">
                            {{$appointment->disease ?? 'N/A' }} <!-- Display disease -->
                        </td>
                        <td class="py-3 px-4">
                            @if($appointment->token)
                                @if($appointment->token->status == 'used')
                                    <span class="text-green-600 font-semibold">Completed</span>
                                @elseif($appointment->token->status == 'active')
                                    <span class="text-red-600 font-semibold">Missed</span>
                                @else
                                    <span class="text-gray-500">{{ ucfirst($appointment->token->status) }}</span>
                                @endif
                            @else
                                <span class="text-gray-500">N/A</span>
                            @endif
                        </td>
                        <td class="py-3 px-4"> <!-- New cell for the button -->
                            @if($appointment->token)
                                <a href="{{ route('patient.showToken', $appointment->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    View Token
                                </a>
                            @else
                                <span class="text-gray-500">No Token</span>
                            @endif
                        </td>

                @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
@endsection
