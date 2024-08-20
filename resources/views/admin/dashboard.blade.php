@extends('layouts.admin_master')
@section('title','Disease Prediction System')

@section('content')
    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Welcome, Admin</h2>
            <p class="mb-6">Manage the system, approve doctors, and monitor user engagement and workflow.</p>

            <!-- Cards Section -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Card 1: Approve Doctors -->
                <div class="bg-green-500 text-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-2">Approve Doctors</h3>
                    <p class="mb-4">Review and approve doctors who have applied to the system.</p>
                    <a href="{{route('admin.managedoctor')}}" class="bg-white text-green-500 py-2 px-4 rounded hover:bg-gray-200">Manage</a>
                </div>

                <!-- Card 2: User Engagement -->
                <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-2">Manage Doctors</h3>
                    <p class="mb-4">Manage doctors and view the list of doctors.</p>
                    <a href="{{route('admin.listdoctor')}}" class="bg-white text-yellow-500 py-2 px-4 rounded hover:bg-gray-200">View Details</a>
                </div>

                <!-- Card 3: Workflow -->
                <div class="bg-blue-500 text-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-2">Workflow</h3>
                    <p class="mb-4">Track the workflow and processes within the system.</p>
                    <a href="{{route('admin.workflow')}}" class="bg-white text-blue-500 py-2 px-4 rounded hover:bg-gray-200">View Workflow</a>
                </div>
            </div>
        </div>
    </div>
@endsection
