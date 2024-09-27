@extends('layouts.patient_master')

@section('title', 'Patient Profile')

@section('content')
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <!-- Profile Card -->
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-5">
            <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white flex justify-between items-center p-4 rounded-t-lg">
                <h3 class="text-lg leading-6 font-medium">Patient Profile</h3>
                <!-- Edit Profile Button -->
                <a href="{{route('patient.edit', $user->id)}}#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6 6M4 4v4a2 2 0 002 2h4M16 5l3 3-9 9H7v-2L16 5z" />
                    </svg>
                    Edit Profile
                </a>
            </div>
            <div class="flex flex-col items-center p-6">
                <!-- Profile Image -->
                <div class="h-32 w-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                    <img src="{{ asset('images\profile_pics\default-profile.jpg') }}" alt="Profile Image" class="h-full w-full object-cover">
                </div>

                <h2 class="mt-4 text-2xl font-semibold">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <p class="text-sm text-gray-500">Patient</p>
            </div>

            <div class="border-t border-gray-200">
                <dl class="divide-y divide-gray-200">
                    <!-- Email Section -->
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $user->email }}
                        </dd>
                    </div>

                    <!-- Date of Birth Section -->
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $user->patient->date_of_birth ? \Carbon\Carbon::parse($user->patient->date_of_birth)->format('F j, Y') : 'Not provided' }}
                        </dd>
                    </div>

                    <!-- Gender Section -->
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Gender</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $user->patient->gender ?? 'Not provided' }}
                        </dd>
                    </div>

                    <!-- Address Section -->
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $user->patient->address ?? 'Not provided' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
