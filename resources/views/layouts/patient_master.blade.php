<!-- resources/views/patient/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include jQuery and Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body class="bg-gray-100 font-sans antialiased flex flex-col min-h-screen">
<!-- Navbar -->
<nav class="bg-blue-700 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-white text-2xl font-bold">Patient Dashboard</h1>
        <div class="flex items-center space-x-6">
            <a href="{{route('patient.dashboard')}}" class="text-white flex items-center hover:text-gray-200">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 4v8m-4-4h4m-4 4h4"></path></svg>
                Home
            </a>
            <a href="#" class="text-white flex items-center hover:text-gray-200">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 0112 15m0 0a9 9 0 017.879 2.804M12 15v5m0 0v5m0-10a9 9 0 017.879-2.804M12 15a9 9 0 00-7.879 2.804M12 15a9 9 0 00-7.879 2.804m7.879-2.804V5m0 0V5m0 0V5m0 0a9 9 0 017.879-2.804A9 9 0 0012 5z"></path></svg>
                Manage Profile
            </a>
{{--            <a href="#" class="text-white flex items-center hover:text-gray-200">--}}
{{--                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v1m-6 4v1"></path></svg>--}}
{{--                Logout--}}
{{--            </a>--}}
            <a class="text-white flex items-center hover:text-gray-200" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6-4v1m-6 4v1"></path></svg>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>
@yield('content')


<!-- Footer -->
<footer class="bg-blue-700 p-4 text-center text-white mt-auto">
    &copy; 2024 Disease Detective. All rights reserved.
</footer>
</body>
</html>
