{{--@extends('layouts.doctor_master')--}}

{{--@section('title', 'manage schedule')--}}

{{--@section('content')--}}
{{--    <!-- Schedule Form -->--}}
{{--    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">--}}
{{--        <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New Schedule</h2>--}}
{{--        <form action="{{ route('doctor.schedule.store') }}" method="POST" class="space-y-6">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <label for="day_of_week" class="block mb-2 text-gray-600 font-medium">Day of Week</label>--}}
{{--                <select name="day_of_week" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">--}}
{{--                    <option value="Sunday">Sunday</option>--}}
{{--                    <option value="Monday">Monday</option>--}}
{{--                    <option value="Tuesday">Tuesday</option>--}}
{{--                    <option value="Wednesday">Wednesday</option>--}}
{{--                    <option value="Thursday">Thursday</option>--}}
{{--                    <option value="Friday">Friday</option>--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="start_time" class="block mb-2 text-gray-600 font-medium">Start Time</label>--}}
{{--                <input type="time" name="start_time" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">--}}
{{--            </div>--}}

{{--            <div class="form-group">--}}
{{--                <label for="end_time" class="block mb-2 text-gray-600 font-medium">End Time</label>--}}
{{--                <input type="time" name="end_time" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">--}}
{{--            </div>--}}

{{--            <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">--}}
{{--                Save Schedule--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--schedule table--}}
{{--    <h2 class="text-xl font-bold mb-4">My Schedule</h2>--}}
{{--    <div class="overflow-x-auto">--}}
{{--        <table class="min-w-full bg-white border border-gray-200">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th class="py-2 px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">Day of Week</th>--}}
{{--                <th class="py-2 px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">Start Time</th>--}}
{{--                <th class="py-2 px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">End Time</th>--}}
{{--                <th class="py-2 px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">Actions</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @forelse ($schedules as $schedule)--}}
{{--                <tr class="hover:bg-gray-100">--}}
{{--                    <td class="py-2 px-4 border-b border-gray-200">{{ $schedule->day_of_week }}</td>--}}
{{--                    <td class="py-2 px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>--}}
{{--                    <td class="py-2 px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>--}}
{{--                    <td class="py-2 px-4 border-b border-gray-200">--}}
{{--                        <form action="{{ route('doctor.schedule.delete', $schedule->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">Delete</button>--}}
{{--                        </form>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @empty--}}
{{--                <tr>--}}
{{--                    <td colspan="4" class="text-center py-4 text-gray-500">No schedules found.</td>--}}
{{--                </tr>--}}
{{--            @endforelse--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}


{{--@endsection--}}

@extends('layouts.doctor_master')

@section('title', 'Manage Schedule')

@section('content')
    <div class="max-w-4xl mx-auto mt-4 lg:mt-8">
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <!-- Switch Buttons -->
        <div class="flex justify-center space-x-4 mb-4 lg:mb-8">
            <button id="showFormButton" class="px-3 py-2 lg:px-4 lg:py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                Add New Schedule
            </button>
            <button id="showTableButton" class="px-3 py-2 lg:px-4 lg:py-2 bg-green-500 text-white font-bold rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300">
                View My Schedule
            </button>
        </div>

        <!-- Schedule Form -->
        <div id="scheduleForm" class="max-w-xl lg:max-w-2xl mx-auto bg-white p-6 lg:p-8 rounded-lg shadow-md">
            <h2 class="text-xl lg:text-2xl font-bold mb-4 lg:mb-6 text-gray-800">Add New Schedule</h2>
            <form action="{{ route('doctor.schedule.store') }}" method="POST" class="space-y-4 lg:space-y-6">
                @csrf
                <div class="form-group">
                    <label for="day_of_week" class="block mb-2 text-gray-600 font-medium">Day of Week</label>
                    <select name="day_of_week" required class="w-full px-3 py-2 lg:px-4 lg:py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="start_time" class="block mb-2 text-gray-600 font-medium">Start Time</label>
                    <input type="time" name="start_time" required class="w-full px-3 py-2 lg:px-4 lg:py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <div class="form-group">
                    <label for="end_time" class="block mb-2 text-gray-600 font-medium">End Time</label>
                    <input type="time" name="end_time" required class="w-full px-3 py-2 lg:px-4 lg:py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <button type="submit" class="w-full py-2 lg:py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                    Save Schedule
                </button>
            </form>
        </div>

        <!-- Schedule Table -->
        <div id="scheduleTable" class="hidden max-w-full">
            <h2 class="text-xl lg:text-2xl font-bold mb-4 lg:mb-6 text-gray-800">My Schedule</h2>
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                    <tr>
                        <th class="py-2 px-2 lg:py-2 lg:px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">Day of Week</th>
                        <th class="py-2 px-2 lg:py-2 lg:px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">Start Time</th>
                        <th class="py-2 px-2 lg:py-2 lg:px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">End Time</th>
                        <th class="py-2 px-2 lg:py-2 lg:px-4 bg-gray-200 border-b-2 border-gray-300 text-left text-gray-600 uppercase font-semibold">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($schedules as $schedule)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-2 lg:py-2 lg:px-4 border-b border-gray-200">{{ $schedule->day_of_week }}</td>
                            <td class="py-2 px-2 lg:py-2 lg:px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                            <td class="py-2 px-2 lg:py-2 lg:px-4 border-b border-gray-200">{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                            <td class="py-2 px-2 lg:py-2 lg:px-4 border-b border-gray-200">
                                <form action="{{ route('doctor.schedule.delete', $schedule->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-md focus:outline-none focus:shadow-outline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">No schedules found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    <script>
        // Get the elements
        const scheduleForm = document.getElementById('scheduleForm');
        const scheduleTable = document.getElementById('scheduleTable');
        const showFormButton = document.getElementById('showFormButton');
        const showTableButton = document.getElementById('showTableButton');

        // Add event listeners to buttons
        showFormButton.addEventListener('click', () => {
            scheduleForm.classList.remove('hidden');
            scheduleTable.classList.add('hidden');
        });

        showTableButton.addEventListener('click', () => {
            scheduleTable.classList.remove('hidden');
            scheduleForm.classList.add('hidden');
        });
    </script>




@endsection
