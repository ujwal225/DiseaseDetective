<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .form-container {
            background: linear-gradient(145deg, #f3f4f6, #e5e7eb);
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.1), -8px -8px 15px rgba(255, 255, 255, 0.7);
        }
        .input-field::placeholder {
            color: #6b7280;
            opacity: 1;
        }
        .input-field:focus::placeholder {
            color: transparent;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
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

<main class="flex-grow container mx-auto py-6 flex items-center justify-center">
    <div class="w-full max-w-4xl form-container p-8 rounded-lg">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Edit Profile</h2>

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- User Information -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-5">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->doctor->phone ?? '') }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-5">
                <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                <input type="text" id="specialization" name="specialization" value="{{ old('specialization', $user->doctor->specialization ?? '') }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-5">
                <label for="profilepic" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <input type="file" id="profilepic" name="profilepic" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-5">
                <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
                <input type="number" id="experience" name="experience" value="{{ old('experience', $user->doctor->experience) }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter Work experience" min="0" max="30">
            </div>

            <div class="mb-5">
                <label for="certificate" class="block text-sm font-medium text-gray-700">Certificate</label>
                <input type="file" id="certificate" name="certificate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-5">
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $user->doctor->location ?? '') }}" class="input-field mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="mb-5">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="input-field mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"></textarea>
            </div>

            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save Changes
            </button>
        </form>
    </div>
</main>

<footer class="bg-blue-800 text-white text-center py-4 mt-auto">
    <p>&copy; 2024 Disease Detective. All rights reserved.</p>
</footer>
</body>
</html>
