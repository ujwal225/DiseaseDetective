{{--@extends('layouts.doctor_master')--}}

{{--@section('title', 'Doctor profile')--}}






{{--@section('content')--}}
{{--    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">--}}
{{--        <div class="bg-white shadow overflow-hidden sm:rounded-lg">--}}
{{--            <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-purple-500 to-blue-500 text-white flex justify-between items-center">--}}
{{--                <h3 class="text-lg leading-6 font-medium">Doctor Profile</h3>--}}
{{--                <!-- Edit Profile Button -->--}}
{{--                <a href="" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6 6M4 4v4a2 2 0 002 2h4M16 5l3 3-9 9H7v-2L16 5z" />--}}
{{--                    </svg>--}}
{{--                    Edit Profile--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="flex items-center justify-center p-6">--}}
{{--                <!-- Profile Image -->--}}
{{--                <div class="flex flex-col items-center">--}}
{{--                    <div class="h-32 w-32 rounded-full overflow-hidden border-4 border-white shadow-lg">--}}
{{--                        <img src="" alt="Profile Image" class="h-full w-full object-cover">--}}
{{--                    </div>--}}
{{--                    <h2 class="mt-4 text-2xl font-semibold"></h2>--}}
{{--                    <p class="text-sm text-gray-500"></p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="border-t border-gray-200">--}}
{{--                <dl>--}}
{{--                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">--}}
{{--                        <dt class="text-sm font-medium text-gray-500">Email</dt>--}}
{{--                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"></dd>--}}
{{--                    </div>--}}
{{--                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">--}}
{{--                        <dt class="text-sm font-medium text-gray-500">Phone</dt>--}}
{{--                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"></dd>--}}
{{--                    </div>--}}
{{--                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">--}}
{{--                        <dt class="text-sm font-medium text-gray-500">Specialization</dt>--}}
{{--                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"></dd>--}}
{{--                    </div>--}}
{{--                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">--}}
{{--                        <dt class="text-sm font-medium text-gray-500">Certificates</dt>--}}
{{--                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">--}}
{{--                            <ul class="list-disc list-inside">--}}
{{--                                @foreach($doctor->certificates as $certificate)--}}
{{--                                    <li>{{ $certificate }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </dd>--}}
{{--                    </div>--}}
{{--                </dl>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
<header class="bg-blue-800 text-white shadow-md py-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-bold flex items-center">
            <i class="fas fa-user-md mr-2"></i> Doctor Dashboard
        </h1>
        <nav class="flex space-x-8 items-center">
            <a href="{{route('doctor.dashboard')}}" class="hover:underline flex items-center">
                <i class="fas fa-home mr-2"></i> Home
            </a>
            <a href="{{route('doctor.profile')}}" class="hover:underline flex items-center">
                <i class="fas fa-user mr-2"></i> Profile
            </a>
            <a class="btn btn-primary flex items-center" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>
</header>

<main class="flex-grow container mx-auto py-6 flex justify-center items-center">
    <!-- Profile Card -->
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-5">
        <div class="bg-gradient-to-r from-purple-500 to-blue-500 text-white flex justify-between items-center p-4 rounded-t-lg">
            <h3 class="text-lg leading-6 font-medium">Doctor Profile</h3>
            <!-- Edit Profile Button -->
            <a href="{{route('doctor.edit', $user->id)}}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6 6M4 4v4a2 2 0 002 2h4M16 5l3 3-9 9H7v-2L16 5z" />
                </svg>
                Edit Profile
            </a>
        </div>
        <div class="flex flex-col items-center p-6">
            <!-- Profile Image -->
            <div class="h-32 w-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                <img src="{{ asset($user->doctor->profilepic) }}" alt="Profile Image" class="h-full w-full object-cover">
            </div>

            <h2 class="mt-4 text-2xl font-semibold">Dr. {{$user->first_name}} {{$user->last_name}}</h2>
            <p class="text-sm text-gray-500">{{$user->doctor->specialization}}</p>
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

                <!-- Phone Section -->
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->doctor->phone ?? 'Not provided' }}
                    </dd>
                </div>

                <!-- Address Section -->
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->doctor->location ?? 'Not provided' }}
                    </dd>
                </div>

                <!-- Specialization Section -->
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Specialization</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->doctor->specialization ?? 'Not provided' }}
                    </dd>
                </div>

                <!-- Experience Section -->
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Experience in years</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $user->doctor->experience ?? 'Not provided' }}
                    </dd>
                </div>

                <!-- Certificates Section -->
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Certificates</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if($user->doctor->certificate)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                                    <div class="border rounded-lg overflow-hidden shadow">
                                        <img src="{{ asset($user->doctor->certificate) }}" alt="Certificate Image" class="w-full h-32 object-cover">
                                    </div>

                            </div>
                        @else
                            <p class="text-gray-500">Not provided</p>
                        @endif
                    </dd>
                </div>

            </dl>
        </div>

    </div>
</main>

<footer class="bg-blue-800 text-white text-center py-4 mt-auto">
    <p>&copy; 2024 Disease Detective. All rights reserved.</p>
</footer>
</body>
</html>


