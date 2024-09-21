@extends('layouts.admin_master')
@section('title', 'Manage Doctor')

@section('content')
    <div class="container mx-auto p-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-lg">
        <h1 class="text-2xl font-extrabold text-white text-center mb-4">Doctor Details</h1>

        @if (session('success'))
            <div class="bg-green-600 text-white text-center p-2 rounded-lg mb-4 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-lg p-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="col-span-1">
                <h2 class="text-xl font-semibold text-center text-gray-800 mb-4">
                    Dr. {{ $user->first_name }} {{$user->last_name}}
                </h2>
                <div class="grid grid-cols-1 gap-2">
                    <div>
                        <strong class="text-gray-600">Email:</strong>
                        <p class="text-sm text-gray-800">{{ $user->email }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-600">Phone:</strong>
                        <p class="text-sm text-gray-800">{{ $user->doctor->phone }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-600">Specialization:</strong>
                        <p class="text-sm text-gray-800">{{ $user->doctor->specialization }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-600">Address:</strong>
                        <p class="text-sm text-gray-800">{{ $user->doctor->location }}</p>
                    </div>
                </div>
            </div>
            <div class="col-span-1 flex flex-col items-center">
                <div class="text-center mb-2">
                    <strong class="text-gray-600">Profile Picture:</strong>
                    @if($user->doctor->profilepic)
                        <img src="{{ asset($user->doctor->profilepic) }}" alt="Profile Image" class="w-24 h-24 rounded-full border-2 border-indigo-500 shadow-lg mt-2">
                    @else
                        <p class="text-gray-500 mt-2">Not provided</p>
                    @endif
                </div>
                <div class="text-center">
                    <strong class="text-gray-600">Certificates:</strong>
                    @if($user->doctor->certificate)
                        <img src="{{ asset($user->doctor->certificate) }}" alt="Certificate Image" class="w-40 h-24 object-cover border-2 border-green-500 rounded-lg shadow-md mt-2">
                    @else
                        <p class="text-gray-500 mt-2">Not provided</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-4 mt-4 text-center">
            <strong class="text-gray-600">Status:</strong>
            <span class="inline-block mt-2 px-4 py-1 text-sm font-semibold rounded-lg text-white
            @if($user->doctor->is_approved == 1)
                bg-green-600
            @else
                bg-yellow-500
            @endif
        ">
            @if($user->doctor->is_approved == 1)
                    Approved
                @else
                    Pending
                @endif
        </span>

            <div class="mt-4">
                <form action="{{ route('admin.approve', $user->doctor->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-blue-600 text-white font-bold px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition duration-200">
                        Approve Doctor
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

