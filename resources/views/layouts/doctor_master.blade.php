
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex flex-col">
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

    <main class="flex flex-grow container mx-auto py-6">


        @if($isApproved)
        <aside class="w-1/4 bg-white shadow-lg p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <i class="fas fa-bars mr-2"></i> Navigation
            </h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{route('doctor.view_appointment')}}" class="block py-2 px-3 bg-blue-100 rounded hover:bg-blue-200 flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i> View Appointments
                    </a>
                </li>

                <li>
                    <a href="{{route('doctor.verifyToken')}}" class="block py-2 px-3 bg-blue-100 rounded hover:bg-blue-200 flex items-center">
                        <i class="fas fa-check mr-2"></i> Verify Token
                    </a>
                </li>


                <li>
                    <a href="{{route('doctor.schedule')}}" class="block py-2 px-3 bg-blue-100 rounded hover:bg-blue-200 flex items-center">
                        <i class="fas fa-clock mr-2"></i> Manage Schedule
                    </a>
                </li>

                <li>
                    <a href="{{route('doctor.manageAppointment')}}" class="block py-2 px-3 bg-blue-100 rounded hover:bg-blue-200 flex items-center">
                        <i class="fas fa-calendar-check mr-2"></i> Manage Appointments
                    </a>
                </li>

                <li>
                    <a href="{{route('doctor.profile')}}" class="block py-2 px-3 bg-blue-100 rounded hover:bg-blue-200 flex items-center">
                        <i class="fas fa-id-card mr-2"></i> View Profile
                    </a>
                </li>
            </ul>
        </aside>

        <!-- main content -->
        <div class="w-3/4 bg-white shadow-lg rounded-lg p-5">

            @yield('content')
        </div>
        @else
            <section class="bg-white shadow-lg p-8 rounded-lg w-full h-full flex flex-col items-center justify-center border border-gray-300 shadow-md">
                <h2 class="text-red-600 text-xl font-bold mb-4"><b>Your account is not approved yet.</b></h2>
                <p class="text-gray-700 mb-6 text-center">
                   Please update your profile. If you have already updated your profile, please wait for admin approval.
                </p>
                <p class="text-gray-800 font-semibold mb-2">
                    To update your profile:
                </p>
                <ul class="list-disc list-inside text-gray-600 mb-4 space-y-3">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 12h18M3 21h18" />
                        </svg>
                       <p>Click on the <b> Profile </b> button in the navigation bar.</p>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                      <P>Click on the  <strong> Edit Profile </strong> button.</P>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6" />
                        </svg>
                        Fill out the form and submit it.
                    </li>

                </ul>

            </section>
        @endif
    </main>

    <footer class="bg-blue-800 text-white text-center py-4">
        <p>&copy; 2024 Disease Detective. All rights reserved.</p>
    </footer>
</div>
</body>
</html>
