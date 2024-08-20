@extends('layouts.admin_master')
@section('title', 'Manage Doctor')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Doctor Details</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-lg font-semibold mb-4"><b>Dr. {{ $user->first_name }} {{$user->last_name}}</b></h2>

            <div class="mb-4">
                <strong>Email:</strong> {{ $user->email }}
            </div>

            <div class="mb-4">
                <strong>Specialization:</strong> {{ $user->doctor->specialization }}
            </div>

            <div class="mb-4">
                <strong>Certificates:</strong> {{ $user->doctor->certificates}}
            </div>

            <div class="mb-4">
                <strong>Experience: </strong> {{$user->doctor->experience}}
            </div>

            <div class="mb-4">
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded text-white
        @if($user->doctor->is_approved == 1)
            bg-green-500
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
            </div>


            <form action="{{ route('admin.approve', $user->doctor->id) }}" method="POST">
                @csrf
                @method('PATCH') <!-- This is crucial to convert the POST request to a PATCH request -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Approve Doctor
                </button>
            </form>
        </div>
    </div>
@endsection

