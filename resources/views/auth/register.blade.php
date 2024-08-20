<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agriculture Theme Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

</head>
<body class="flex h-screen items-center justify-center bg-cover bg-center bg-fixed bg-gradient-to-t from-black via-black to-transparent" style="background-image: linear-gradient(to top, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.5) 50%), url('{{asset('/images/bg_image/ca-background.jpg')}}');">
<div class="m-auto mt-14 mb-5 flex w-full max-w-4xl overflow-hidden rounded-lg bg-purple-50 shadow-lg">
    <!-- Left Side -->
    <div class="relative flex w-1/3 flex-col items-center justify-center rounded-lg bg-gradient-to-b from-green-300 to-green-700 p-8 text-white">
        <div class="absolute left-4 top-4">
            <img src="{{asset('/images/bg_image/lolo-removebg-preview.png')}}" alt="logo" class="w-20 h-20"/>
        </div>
        <h2 class="mb-4 text-purple-100 text-center text-2xl font-bold">Fresh food, vibrant life awaits.</h2>
        <div class="relative h-10 w-72">
            <!-- Placeholder for 3D illustration -->
            <img src="{{asset('/images/bg_image/vgg-removebg.png')}}" alt="3d image of vegetables" />
        </div>
    </div>
    <!-- Right Side -->
    <div class="w-2/3 p-14 pl-20">
        <h2 class="mb-6 text-3xl font-bold text-purple-500">Create Account</h2>
        <form action="{{route('register')}}" method="POST" class="space-y-4" novalidate>
            @csrf
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <input type="text" placeholder="First Name" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 @error('firstname') border-red-500 @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus />
                    @error('firstname')
                    <span class="text-red-500 block mt-1" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-1/2">
                    <input type="text" placeholder="Last Name" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 @error('lastname') border-red-500 @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus/>
                    @error('lastname')
                    <span class="text-red-500 block mt-1" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <input type="email" placeholder="Email" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}"  required autocomplete="email"/>
            @error('email')
            <span class="text-red-500 block mt-1" role="alert">{{ $message }}</span>
            @enderror
            <input type="password" placeholder="Password" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password"/>
            @error('password')
            <span class="text-red-500 block mt-1" role="alert">{{ $message }}</span>
            @enderror
            <input type="password" placeholder="Confirm Password" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 @error('confirm_password') border-red-500 @enderror" name="password_confirmation" required autocomplete="new-password"/>
            @error('confirm_password')
            <span class="text-red-500 block mt-1" role="alert">{{ $message }}</span>
            @enderror
            <select id="dropdown" name="user_type" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-400 @error('user_type') border-red-500 @enderror" required>
                <option value="" disabled selected>Choose role</option>
                <option value="Doctor">Doctor</option>
                <option value="Patient">Patient</option>
            </select>
            @error('user_type')
            <span class="text-red-500 block mt-1" role="alert">{{ $message }}</span>
            @enderror
            <button type="submit" class="w-full rounded-lg bg-purple-500 py-2 text-white hover:bg-purple-600">Create Account</button>
        </form>
        <p class="mt-4">Already have an account? <a href="{{route('login')}}" class="text-purple-600">Login</a></p>
    </div>
</div>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
