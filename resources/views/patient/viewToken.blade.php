@extends('layouts.patient_master')

@section('title', 'View Token')

@section('content')
    <div class="max-w-2xl mx-auto my-8 bg-white shadow-lg rounded-lg border border-gray-200 p-6 transform transition-all duration-300 hover:shadow-xl hover:scale-105">
        <!-- Token Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h2 class="text-2xl font-bold mx-5 text-gray-800">Appointment Token</h2>
            <span class="bg-blue-600 text-white py-2 px-5 rounded-full font-bold text-lg">
                <i class="fas fa-ticket-alt"></i> {{ $token->token_number  }}
            </span>
        </div>

        <!-- Appointment Information -->
        <div class="mb-4">
            <p class="text-gray-600">
                <span class="font-semibold text-gray-800">Appointment Date:</span> {{ \Carbon\Carbon::parse($token->appointment->appointment_date)->format('l, F j, Y') }}
            </p>
            <p class="text-gray-600">
                <span class="font-semibold text-gray-800">Appointment Time:</span> {{ \Carbon\Carbon::parse($token->appointment->appointment_time)->format('g:i A') }}
            </p>
        </div>


        <!-- Doctor Information -->
        <div class="border-t pt-4">

             <h3 class="text-lg font-semibold text-gray-800">Doctor Details</h3>
            <p class="text-gray-600">
                <i class="fas fa-user-md text-blue-600 ml-2 mr-3"></i> <span class="font-semibold">Name:</span> Dr. {{ $token->appointment->doctor->user->first_name }} {{ $token->appointment->doctor->user->last_name }}

            </p>
            <p class="text-gray-600">
                <i class="fas fa-map-marker-alt text-blue-600 ml-2 mr-3"></i> <span class="font-semibold">Location:</span> {{ $token->appointment->doctor->location }}

            </p>
        </div>

        <!-- Patient Information -->
        <div class="border-t pt-4 mt-4">
            <h3 class="text-lg font-semibold text-gray-800">Patient Details</h3>
            <p class="text-gray-600">
                <i class="fas fa-user text-blue-600 ml-2 mr-3"></i><span class="font-semibold">Name:</span> {{ $token->appointment->patient->user->first_name }} {{ $token->appointment->patient->user->last_name }}

            </p>
        </div>
    </div>
@endsection
