@extends('layouts.patient_master')

@section('title', 'Requested Appointments')

@section('content')
    <div class="container mx-auto mt-6">
        @if(session('success'))
            <div class="bg-green-200 text-green-700 p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 text-red-700 p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            @if($appointments->isEmpty())
                <div class="text-center p-4 bg-gray-200 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">No Appointments Yet</h2>
                    <p class="text-gray-600">It seems you haven't scheduled any appointments. Take the first step towards your health by booking an appointment with one of our doctors.</p>
                    <a href="{{ route('patient.preform') }}" class="mt-2 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Predict Disease
                    </a>
                </div>
            @else
                <table class="min-w-full bg-white rounded-lg shadow-md">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left text-gray-700">Doctor Name</th>
                        <th class="py-2 px-4 text-left text-gray-700">Appointment Date</th>
                        <th class="py-2 px-4 text-left text-gray-700">Appointment Time</th>
                        <th class="py-2 px-4 text-left text-gray-700">Status</th>
                        <th class="py-2 px-4 text-left text-gray-700">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $appointment)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y')}}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</td>
                            <td class="py-3 px-4">
                                @if($appointment->status == 'approved')
                                    <span class="text-green-600 font-semibold">Approved</span>
                                @elseif($appointment->status == 'pending')
                                    <span class="text-yellow-500 font-semibold">Pending</span>
                                @elseif($appointment->status == 'rejected')
                                    <span class="text-red-600 font-semibold">Rejected</span>
                                @else
                                    <span class="text-gray-500">Unknown</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                @if($appointment->status == 'approved')
                                    <a href="{{ route('patient.showToken', ['appointment_id' => $appointment->id]) }}" class="bg-blue-600 text-white py-1 px-3 rounded-full hover:bg-blue-700 transition-colors duration-200">
                                        View Token
                                    </a>
                                @elseif($appointment->status == 'pending')
                                    <form action="{{ route('patient.appointment.destroy', $appointment->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded-full hover:bg-red-700 transition-colors duration-200">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Pagination Links -->
        @if(!$appointments->isEmpty())
            <div class="mt-4">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
@endsection

