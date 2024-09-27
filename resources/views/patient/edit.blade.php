@extends('layouts.patient_master')

@section('title', 'Edit Profile')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-5">
            <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white flex justify-between items-center p-4 rounded-t-lg">
                <h3 class="text-lg leading-6 font-medium">Edit Patient Profile</h3>
            </div>

            <form action="{{ route('patient.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT') <!-- Use PUT method for updates -->

                <!-- User Information -->
                <div class="mb-5 flex space-x-4">
                    <div class="flex-1">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="flex-1">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>

                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ $user->patient->date_of_birth }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled>Select Gender</option>
                        <option value="male" {{ $user->patient->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->patient->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $user->patient->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ $user->patient->address }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

