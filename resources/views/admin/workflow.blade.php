@extends('layouts.admin_master')
@section('title','Workflow')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Dashboard Overview -->
        <div class="bg-white shadow rounded-lg p-4 mb-4">
            <h2 class="text-2xl font-bold mb-4">Dashboard Overview</h2>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Total Users -->
                <div class="bg-blue-100 p-6 rounded-lg shadow-md flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 p-4 rounded-full mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18v18H3V3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800">Total Users</h3>
                        <p class="text-3xl font-bold text-blue-800">{{ $totalUsers - 1 }}</p>
                    </div>
                </div>
                <!-- Active Doctors -->
                <div class="bg-green-100 p-6 rounded-lg shadow-md flex items-center">
                    <div class="flex-shrink-0 bg-green-500 p-4 rounded-full mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-green-800">Active Doctors</h3>
                        <p class="text-3xl font-bold text-green-800">{{ $activeDoctors }}</p>
                    </div>
                </div>
                <!-- Pending Approvals -->
                <div class="bg-yellow-100 p-6 rounded-lg shadow-md flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 p-4 rounded-full mr-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-yellow-800">Pending Approvals</h3>
                        <p class="text-3xl font-bold text-yellow-800">{{ $pendingApprovals }}</p>
                    </div>
                </div>
            </div>
        </div>



        <!-- Recent Activities -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-2xl font-bold mb-4">Activities</h2>

            <!-- Monthly Registrations and Predictions -->
            <div class="space-y-4">
                <!-- Monthly User Registrations -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <h3 class="text-xl font-semibold">Monthly User Registrations</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($monthlyUserRegistrations as $month => $count)
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700">{{ \DateTime::createFromFormat('!m', $month)->format('F') }}</span>
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-semibold">{{ $count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Monthly User Predictions -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M9 8h6"></path>
                        </svg>
                        <h3 class="text-xl font-semibold">Monthly User Predictions</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($monthlyUserPredictions as $month => $count)
                            <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-700">{{ \DateTime::createFromFormat('!m', $month)->format('F') }}</span>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-semibold">{{ $count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
