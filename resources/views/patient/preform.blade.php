{{--<!-- resources/views/patient/home.blade.php -->--}}
{{--@extends('layouts.patient_master')--}}

{{--@section('title', 'Patient Home')--}}

{{--@section('content')--}}
{{--    <!-- Main Content -->--}}
{{--    <div class="container mx-auto mt-10 flex-grow">--}}
{{--        <div class="flex justify-center">--}}
{{--            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">--}}
{{--                <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Predict Disease</h2>--}}


{{--                <form action="{{route('patient.predict.disease')}}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <div class="mb-6">--}}
{{--                        <label for="symptoms" class="block text-gray-700 font-medium mb-2">Enter Symptoms</label>--}}
{{--                        <select id="symptoms" name="symptoms[]" class="w-full border border-gray-300 rounded-lg select2" multiple="multiple">--}}
{{--                            <!-- Predefined symptoms -->--}}
{{--                            @foreach($symptoms as $symptom)--}}
{{--                                <option value="{{ $symptom }}">{{ $symptom }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="text-center">--}}
{{--                        <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-700 transition-colors duration-200">Predict</button>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- Predicted Disease Card -->--}}
{{--        @if (session('predictedDisease'))--}}
{{--            <div class="flex justify-center mt-10">--}}
{{--                <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">--}}

{{--                    <div class="bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg">--}}
{{--                        <h3 class="text-lg font-semibold">Predicted Disease:</h3>--}}
{{--                        <p class="text-xl font-bold">{{ session('predictedDisease') }}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--    @if ($errors->any())--}}
{{--        <div>--}}
{{--            <strong>Error:</strong>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            // Initialize Select2--}}
{{--            $('#symptoms').select2({--}}
{{--                placeholder: 'Type and select symptoms...',--}}
{{--                tags: false, // Disable custom tags, only allow predefined symptoms--}}
{{--                width: '100%',--}}
{{--                allowClear: true,--}}
{{--                maximumSelectionLength: 8 // Limit selection to a maximum of 8 symptoms--}}
{{--            });--}}

{{--            // Form submission handler--}}
{{--            $('form').on('submit', function(event) {--}}
{{--                var selectedSymptoms = $('#symptoms').val();--}}
{{--                if (selectedSymptoms.length < 5) {--}}
{{--                    event.preventDefault(); // Prevent form submission--}}
{{--                    alert('You must select at least 5 symptoms.');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}



{{--@endsection--}}
<!-- resources/views/patient/home.blade.php -->
@extends('layouts.patient_master')

@section('title', 'Patient Home')

@section('content')
    <!-- Main Content -->
    <div class="container mx-auto mt-10 flex-grow relative">
        <div class="flex justify-center">
            <!-- Disease Prediction Form -->
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Predict Disease</h2>

                <form action="{{ route('patient.predict.disease') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="symptoms" class="block text-gray-700 font-medium mb-2">Enter Symptoms</label>
                        <select id="symptoms" name="symptoms[]" class="w-full border border-gray-300 rounded-lg select2" multiple="multiple">
                            <!-- Predefined symptoms -->
                            @foreach($symptoms as $symptom)
                                <option value="{{ $symptom }}">{{ $symptom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-700 transition-colors duration-200">Predict</button>
                    </div>
                </form>

                <!-- Predicted Disease Card -->
                @if (session('predictedDisease'))
                    <div class="mt-6 bg-green-100 border border-green-300 text-green-800 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Predicted Disease:</h3>
                        <p class="text-xl font-bold">{{ session('predictedDisease') }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Suggested Doctors Popup (Initially hidden) -->
        @if (session('predictedDisease'))
            @php
                $doctors = session('doctors');
            @endphp

            <div id="doctor-suggestions" class="fixed top-0 right-0 h-full w-96 bg-white shadow-2xl p-6 rounded-l-lg border-l border-gray-300 overflow-y-auto z-50">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 text-green-700"><b>Suggested Doctors</b></h3>

                <ul>
                    @if(count($doctors) > 0)
                        @foreach($doctors as $doctor)
                            <div class="flex flex-col bg-gray-50 rounded-lg shadow-md mt-20 mb-4 border border-gray-200 transition-transform transform hover:scale-105 ">
                                <!-- Doctor Image -->
                                <img src="{{ asset($doctor->profilepic) }}" alt="Doctor" class="w-24 h-24 rounded-full mx-auto -mt-12 border-4 border-indigo-500 shadow-lg">

                                <!-- Doctor Info -->
                                <div class="text-center flex-grow p-4">
                                    <p class="text-lg font-bold text-gray-800">Dr. {{$doctor->User->first_name}} {{$doctor->User->last_name}}</p>
                                    <p class="text-sm text-gray-600">Specialization: <span class="font-medium text-indigo-600">{{$doctor->specialization}}</span></p>
                                    <p class="text-sm text-gray-600">Location: {{$doctor->location}}</p>
                                </div>

                                <!-- View Doctor Button -->
                                <div class="mb-4 flex justify-center">
                                    <a href="{{ route('patient.book_appointment', ['doctorId' => $doctor->id]) }}" class="bg-indigo-600 text-white py-2 px-4 text-sm rounded-lg hover:bg-indigo-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">View Doctor</a>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <!-- Message if no doctors are found -->
                        <p class="text-center text-gray-600">No doctors found for the predicted disease.</p>
                    @endif
                </ul>

                <!-- Close Button for Popup -->
                <button id="close-popup" class="absolute top-4 right-4 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition-colors duration-200">X</button>
            </div>
        @endif
    </div>


        <!-- Display validation errors -->
    @if ($errors->any())
        <div>
            <strong>Error:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#symptoms').select2({
                placeholder: 'Type and select symptoms...',
                tags: false, // Disable custom tags, only allow predefined symptoms
                width: '100%',
                allowClear: true,
                maximumSelectionLength: 8 // Limit selection to a maximum of 8 symptoms
            });

            // Form submission handler
            $('form').on('submit', function(event) {
                var selectedSymptoms = $('#symptoms').val();
                if (selectedSymptoms.length < 5) {
                    event.preventDefault(); // Prevent form submission
                    alert('You must select at least 5 symptoms.');
                }
            });

            // Show doctor suggestions if a disease is predicted
            @if (session('predictedDisease'))
            $('#doctor-suggestions').removeClass('hidden').fadeIn(); // Show popup
            @endif

            // Close button for popup
            $('#close-popup').on('click', function() {
                $('#doctor-suggestions').fadeOut(); // Hide popup when close button is clicked
            });
        });
    </script>
@endsection
