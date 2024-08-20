<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="bg-blue-900 text-white w-1/4 p-4 flex flex-col justify-between">
        <div>
            <h1 class="text-2xl font-bold mb-8">Admin Dashboard</h1>
            <ul>
                <li class="mb-4"><a href="{{route('admin.dashboard')}}" class="text-lg hover:underline">Home</a></li>
                <li class="mb-4"><a href="{{route('admin.managedoctor')}}" class="text-lg hover:underline">Approve Doctors</a></li>
                <li class="mb-4"><a href="{{route('admin.listdoctor')}}" class="text-lg hover:underline">Manage Doctors</a></li>
                <li class="mb-4"><a href="{{route('admin.workflow')}}" class="text-lg hover:underline">Workflow</a></li>
            </ul>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
{{--    <!-- Main Content -->--}}

    @yield('content')
{{--    <div class="flex-1 p-8">--}}
{{--        <div class="bg-white p-6 rounded-lg shadow-lg">--}}
{{--            <h2 class="text-2xl font-bold mb-4">Welcome, Admin</h2>--}}
{{--            <p class="mb-6">Manage the system, approve doctors, and monitor user engagement and workflow.</p>--}}

{{--            <!-- Cards Section -->--}}
{{--            <div class="grid grid-cols-3 gap-6">--}}
{{--                <!-- Card 1: Approve Doctors -->--}}
{{--                <div class="bg-green-500 text-white p-4 rounded-lg shadow-lg">--}}
{{--                    <h3 class="text-xl font-bold mb-2">Approve Doctors</h3>--}}
{{--                    <p class="mb-4">Review and approve doctors who have applied to the system.</p>--}}
{{--                    <a href="#" class="bg-white text-green-500 py-2 px-4 rounded hover:bg-gray-200">Manage</a>--}}
{{--                </div>--}}

{{--                <!-- Card 2: User Engagement -->--}}
{{--                <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-lg">--}}
{{--                    <h3 class="text-xl font-bold mb-2">Manage Doctors</h3>--}}
{{--                    <p class="mb-4">Manage doctors and view the list of doctors.</p>--}}
{{--                    <a href="#" class="bg-white text-yellow-500 py-2 px-4 rounded hover:bg-gray-200">View Details</a>--}}
{{--                </div>--}}

{{--                <!-- Card 3: Workflow -->--}}
{{--                <div class="bg-blue-500 text-white p-4 rounded-lg shadow-lg">--}}
{{--                    <h3 class="text-xl font-bold mb-2">Workflow</h3>--}}
{{--                    <p class="mb-4">Track the workflow and processes within the system.</p>--}}
{{--                    <a href="#" class="bg-white text-blue-500 py-2 px-4 rounded hover:bg-gray-200">View Workflow</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

</body>
</html>
