<!-- resources/views/patient/home.blade.php -->
@extends('layouts.patient_master')

@section('title', 'Patient Home')

@section('content')
    <!-- Main Content -->
    <div class="container mx-auto mt-10 flex-grow">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Predict Disease -->
            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9a2.25 2.25 0 01-2.25 2.25A2.25 2.25 0 015.25 9a2.25 2.25 0 012.25-2.25M14.25 9A2.25 2.25 0 0116.5 11.25 2.25 2.25 0 0114.25 9M5.25 9v5.25c0 3.75 5.25 5.25 5.25 5.25s5.25-1.5 5.25-5.25V9M8.25 18H15"></path></svg>
                    </div>
                    <h2 class="ml-4 text-xl font-semibold text-gray-800">Predict Disease</h2>
                </div>
                <p class="text-gray-600 mb-4">Enter your symptoms to predict the possible disease using our advanced algorithm.</p>
                <a href="{{route('patient.preform')}}" class="bg-blue-600 text-white py-2 px-6 rounded-full hover:bg-blue-700 transition-colors duration-200">Start Prediction</a>
            </div>

{{--            <!-- View Tokens -->--}}
{{--            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">--}}
{{--                <div class="flex items-center mb-4">--}}
{{--                    <div class="bg-green-100 p-3 rounded-full">--}}
{{--                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9a2.25 2.25 0 01-2.25 2.25A2.25 2.25 0 015.25 9a2.25 2.25 0 012.25-2.25M14.25 9A2.25 2.25 0 0116.5 11.25 2.25 2.25 0 0114.25 9M5.25 9v5.25c0 3.75 5.25 5.25 5.25 5.25s5.25-1.5 5.25-5.25V9M8.25 18H15"></path></svg>--}}
{{--                    </div>--}}
{{--                    <h2 class="ml-4 text-xl font-semibold text-gray-800">View Tokens</h2>--}}
{{--                </div>--}}
{{--                <p class="text-gray-600 mb-4">Check and manage your current and previous consultation tokens easily.</p>--}}
{{--                <a href="#" class="bg-green-600 text-white py-2 px-6 rounded-full hover:bg-green-700 transition-colors duration-200">View Tokens</a>--}}
{{--            </div>--}}

            <!-- View Requested Appointments -->
            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center mb-4">
                    <div class="bg-red-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8M8 11h8M8 15h4"></path></svg>
                    </div>
                    <h2 class="ml-4 text-xl font-semibold text-gray-800">View Requested Appointments</h2>
                </div>
                <p class="text-gray-600 mb-4">Check the status of your requested appointments.</p>
                <a href="{{route('patient.reqAppointment')}}" class="bg-red-600 text-white py-2 px-6 rounded-full hover:bg-red-700 transition-colors duration-200">View Appointments</a>
            </div>

            <!-- Manage Profile -->
            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center mb-4">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h2 class="ml-4 text-xl font-semibold text-gray-800">Manage Profile</h2>
                </div>
                <p class="text-gray-600 mb-4">Update your personal details and account settings to stay up to date.</p>
                <a href="#" class="bg-yellow-600 text-white py-2 px-6 rounded-full hover:bg-yellow-700 transition-colors duration-200">Manage Profile</a>
            </div>

        </div>
    </div>
@endsection
