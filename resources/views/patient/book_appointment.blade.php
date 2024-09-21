@extends('layouts.patient_master')

{{--@extends('title','book appointment')--}}

@section('content')
    <div class="container">
        <h1>Book an Appointment with Dr. {{ $doctor->User->first_name }} {{ $doctor->User->last_name }}</h1>
        <p>Specialization: {{ $doctor->specialization }}</p>
        <p>Location: {{ $doctor->location }}</p>

        <!-- Appointment Booking Form -->
        <form id="appointment-form" method="POST" action="{{ route('patient.book_appointment.store') }}">
            @csrf
            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

            <!-- Date Selection -->
            <label for="appointment_date">Select Appointment Date:</label>
            <input type="date" id="appointment_date" name="appointment_date" required>

            <!-- Time Slots (dynamically populated) -->
            <label for="appointment_time">Available Time Slots:</label>
            <select id="appointment_time" name="appointment_time" required>
                <option value="">Select a time slot</option>
            </select>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mt-4">Book Appointment</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        console.log('hello! im ujwal silwal');
        document.getElementById('appointment_date').addEventListener('change', function() {
            const doctorId = {{ $doctor->id }};
            const selectedDate = this.value;
            const timeSlotSelect = document.getElementById('appointment_time');


            // Clear existing options
            timeSlotSelect.innerHTML = '<option value="">Select a time slot</option>';

            console.log(`Fetching available slots for doctor ${doctorId} on date ${selectedDate}`);

            // Fetch available slots via AJAX
            fetch(`/api/patient/available-slots/${doctorId}/date=${selectedDate}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Available slots data:', data); // Log the data

                    if (data.error) {
                        alert(data.error);
                    } else {
                        data.forEach(slot => {
                            const option = document.createElement('option');
                            option.value = slot;
                            option.textContent = slot;
                            timeSlotSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching time slots:', error);
                });

        });

    </script>
@endsection
