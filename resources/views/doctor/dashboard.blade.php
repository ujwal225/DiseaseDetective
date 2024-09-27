

@extends('layouts.doctor_master')

@section('title', 'Doctor Dashboard')

@section('content')
    <section class="bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-3xl font-semibold mb-6 flex items-center">
            <i class="fas fa-user-md mr-3 text-blue-600"></i> Welcome, Dr. {{$userName}}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="bg-blue-100 p-6 rounded-lg shadow-lg flex items-center">
                <a href="{{route('doctor.view_appointment')}}">
                    <div class="mr-4 text-blue-600">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-1">Upcoming Appointments</h3>
                        <p class="text-gray-700">You have {{ $todayAppointmentCount ?? '0' }} appointments today.</p>
                    </div>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="bg-green-100 p-6 rounded-lg shadow-lg flex items-center">
                <a href="{{route('doctor.schedule')}}">
                    <div class="mr-4 text-green-600">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-1">Schedule</h3>
                        <p class="text-gray-700">Your schedule is up to date.</p>
                    </div>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="bg-blue-100 p-6 rounded-lg shadow-lg flex items-center">
                <a href="{{ route('doctor.manageAppointment') }}">
                    <div class="mr-4 text-blue-600">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-1">Manage Appointments</h3>
                        <p class="text-gray-700">Manage your appointments effectively.</p>
                    </div>
                </a>
            </div>

            <!-- Card 4 - Verify Token -->
            <div class="bg-purple-100 p-6 rounded-lg shadow-lg flex items-center">
                <a href="{{route('doctor.verifyToken')}}">
                    <div class="mr-4 text-purple-600">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-1">Verify Token</h3>
                        <p class="text-gray-700">Verify appointment tokens here.</p>
                    </div>
                </a>
            </div>

            <!-- Card 5 -->
            <div class="bg-yellow-100 p-6 rounded-lg shadow-lg flex items-center">
                <a href="{{route('doctor.profile')}}">
                    <div class="mr-4 text-yellow-600">
                        <i class="fas fa-id-card fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-1">Profile</h3>
                        <p class="text-gray-700">Update your profile information.</p>
                    </div>
                </a>
            </div>



        </div>
    </section>

@endsection
