<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agriculture Theme Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="flex h-screen items-center justify-center bg-cover bg-center bg-fixed" style="background-image: linear-gradient(to top, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.5) 50%), url('{{ asset('images/bg_image/lg-background.jpg') }}');">
<div class="absolute left-4 top-4">
    <img src="{{asset('/images/bg_image/lolo-removebg-preview.png')}}" alt="logo" class="w-20 h-20"/>
</div>

<div class="flex w-full max-w-md flex-col items-center justify-center bg-white bg-opacity-80 p-8 rounded-lg shadow-lg">
    <h2 class="mb-4 text-3xl font-bold text-green-600">Login</h2>
    <form action="{{route('login')}}" method="POST" class="w-full space-y-4">
        @csrf
        <div class="relative">
            <input type="text" placeholder="Email" name="email" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600 @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus/>
            <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
        </div>

            @error('email')
            <span class="text-red-500" role="alert">
                                        {{ $message }}
                                    </span>
            @enderror



        <div class="relative">
            <input type="password" placeholder="Password" class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
            <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
        </div>
        @error('password')
        <span class="text-red-500" role="alert">
                                        {{ $message }}
                                    </span>
        @enderror

        <button type="submit" class="w-full rounded-lg bg-green-600 py-2 text-white hover:bg-green-700">Sign In</button>
        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center text-lg">
                <input type="checkbox" class="form-checkbox text-purple-500 transform scale-150" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                <span class="ml-2 ">{{__('Remember me')}}</span>
            </label>
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-green-600 font-bold text-lg">Forgot password?</a>
            @endif
        </div>
    </form>
    <p class="mt-4 text-lg">Don't have an account? <a href="{{route('register')}}" class="text-green-600 font-bold">Sign Up</a></p>
</div>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
