@extends('layouts.patient_master')

{{--@extends('title','book appointment')--}}
@section('content')
    <div class="container mx-auto p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Doctor's Information Card -->
            <aside class="bg-gradient-to-r from-blue-50 to-white shadow-lg rounded-lg p-8 transform transition hover:scale-105 duration-300 ease-in-out">
                <div class="flex items-center space-x-6">
                    <img class="w-20 h-20 rounded-full object-cover border-4 border-green-500" src="{{ asset($doctor->profilepic) }}" alt="Doctor Image">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Dr. {{ $doctor->User->first_name }} {{ $doctor->User->last_name }}
                        </h2>
                        <p class="text-sm text-indigo-500 font-medium">{{ $doctor->specialization }}</p>
                        <p class="inline-flex items-center bg-green-500 text-white my-3 py-1 px-4 rounded-full shadow-md">
                            <i class="fas fa-check-circle mr-2"></i> Verified
                        </p>
                    </div>
                </div>
                <div class="mt-8 bg-gradient-to-r from-white via-gray-50 to-gray-100 border border-gray-300 py-6 px-8 rounded-xl shadow-lg">
                    <p class="text-base text-gray-800">
                        <span class="font-bold text-gray-900">Location:</span>
                        <span class="font-medium">{{ $doctor->location }}</span>
                    </p>
                    <p class="text-base text-gray-800 mt-3">
                        <span class="font-bold text-gray-900">Experience:</span>
                        <span class="font-medium">{{ $doctor->experience }} years</span>
                    </p>
                    <p class="text-base text-gray-800 mt-3">
                        <span class="font-bold text-gray-900">Contact:</span>
                        <span class="font-medium">{{ $doctor->phone }}</span>
                    </p>
                    <p class="text-base text-gray-800 mt-3">
                        <span class="font-bold text-gray-900">Description:</span>
                        <span class="font-medium">{{ $doctor->description }}</span>
                    </p>
                </div>

            </aside>


            <!-- Appointment Booking Form -->
            <div class="bg-gradient-to-br from-gray-50 to-white shadow-xl rounded-2xl p-8 max-w-lg mx-auto">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Book an Appointment</h2>
                <form id="appointment-form" method="POST" action="{{ route('patient.book_appointment.store') }}" class="space-y-8">
                    @csrf
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                    <!-- Date Selection -->
                    <div>
                        <label for="appointment_date" class="block text-sm font-semibold text-gray-700 mb-2">Select Appointment Date:</label>
                        <input type="date" id="appointment_date" name="appointment_date" min="{{ date('Y-m-d') }}" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-base transition-all duration-300 ease-in-out p-5">
                    </div>

                    <!-- Time Slots (dynamically populated) -->
                    <div>
                        <label for="appointment_time" class="block text-sm font-semibold text-gray-700 mb-2">Available Time Slots:</label>
                        <select id="appointment_time" name="appointment_time" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-md focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:text-base transition-all duration-300 ease-in-out p-5">
                            <option value="">Select a time slot</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold rounded-full py-3 px-5 hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-4 focus:ring-indigo-400 focus:ring-offset-2 transition-all duration-300 ease-in-out shadow-lg">Book Appointment</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Error Dialog Box -->
        @if($errors->any())
            <div class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg p-6 shadow-lg max-w-sm w-full">
                    <h3 class="text-lg font-medium text-red-600">Appointment Conflict</h3>
                    <p class="text-sm text-gray-500">You already have an appointment with this doctor. Please wait until your current appointment is completed or expired.</p>
                    <div class="mt-4">
                        <button onclick="this.closest('.fixed').style.display='none'" class="w-full bg-red-600 text-white font-semibold rounded-lg py-2">OK</button>
                    </div>
                </div>
            </div>
        @endif

        </div>

@endsection
@section('script')
    <script>

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

        // Ensure the minimum date is set to today in the input field dynamically
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('appointment_date').setAttribute('min', today);
        });


    </script>
@endsection
