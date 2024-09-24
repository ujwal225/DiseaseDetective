@extends('layouts.doctor_master')

@section('title','appointment_detail')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-semibold mb-4">Appointment Details</h2>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <p><strong>Patient Name:</strong> {{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}</p>
            <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F j, Y') }}</p>
            <p><strong>Appointment Time:</strong> {{ $appointment->appointment_time }}</p>
            <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
            <p><strong>Notes:</strong> {{ $appointment->notes ?? 'No additional notes' }}</p>

            <h2 class="text-lg font-semibold">Patient Reports</h2>

            @if ($patientReports->isEmpty())
                <p>No reports available for this patient.</p>
            @else
                <ul>
                    @foreach ($patientReports as $report)
                        <li>
                            <strong>Disease:</strong> {{ $report->predicted_disease }}<br>
                            <strong>Symptoms:</strong>
                            <ul>
                                <li>{{ implode(', ', json_decode($report->symptoms, true)) }}</li>
                            </ul>
                            <strong>Reported On:</strong> {{ $report->created_at->format('Y-m-d H:i') }}
                        </li>
                    @endforeach
                </ul>
            @endif


            <!-- Add any additional details or actions, such as approve/reject buttons -->
        </div>

        <div class="mt-4">
            <form action="{{ route('doctor.appointment_details.approve', $appointment->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    Approve Appointment
                </button>
            </form>
        </div>
    </div>
@endsection
