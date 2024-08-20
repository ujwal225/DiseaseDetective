@extends('layouts.admin_master')
@section('title','Manage Doctors')

@section('content')
    <div class="flex-1 p-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-center">Approve Doctors</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full table-auto text-center">
                <thead>
                <tr class="bg-gray-200">
                    <th class="p-4">Name</th>
                    <th class="p-4">Email</th>

                    <th class="p-4">Status</th>
                    <th class="p-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($doctors as $doctor)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-4">
                            <span class="flex items-center justify-center">
                                {{ $doctor->first_name }} {{$doctor->last_name}}
                            </span>
                        </td>
                        <td class="p-4">{{ $doctor->email }}</td>

                        <td class="p-4 font-bold">
                            @if($doctor->doctor->approved)
                                <span class="bg-green-500 text-white py-1 px-3 rounded-full inline-block">Approved</span>
                            @else
                                <span class="bg-yellow-500 text-white py-1 px-3 rounded-full inline-block">Pending</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.approveindex', $doctor->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 4.5C6.48 4.5 2.2 8.91 1.28 14.04a1 1 0 0 0 0 1.92C2.2 19.09 6.48 23.5 12 23.5s9.8-4.41 10.72-9.54a1 1 0 0 0 0-1.92C21.8 8.91 17.52 4.5 12 4.5zm0 14a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0-9a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z" />
                                    </svg>
                                    View
                                </a>
{{--
                                {{-- Uncomment and use the following buttons for approval/rejection functionality --}}
                                {{--
                                <form action="{{ route('admin.doctors.approve', $doctor) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 4.293a1 1 0 00-1.414 0L9 10.586 6.707 8.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.doctors.reject', $doctor) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.293-9.707a1 1 0 00-1.414-1.414L10 9.586 8.121 7.707a1 1 0 10-1.414 1.414l2.293 2.293-2.293 2.293a1 1 0 101.414 1.414L10 12.414l1.879 1.879a1 1 0 001.414-1.414l-2.293-2.293z" clip-rule="evenodd" />
                                        </svg>
                                        Reject
                                    </button>
                                </form>
                                --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if($doctors->isEmpty())
                <p class="text-center text-gray-500 mt-6">No doctors pending approval.</p>
            @endif
        </div>
    </div>

@endsection
