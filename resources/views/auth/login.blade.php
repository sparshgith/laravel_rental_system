<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Rental Management System</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Applying a smooth font for the entire page */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">

            <!-- Left Side: Login Form -->
            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-4xl font-bold">Welcome Back</span>
                <span class="font-light text-gray-500 mb-8">
                    Log in to access your dashboard and manage your properties.
                </span>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="py-4">
                        <label for="email" class="mb-2 text-md font-light text-gray-600">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full p-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your email address"
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="py-4">
                        <label for="password" class="mb-2 text-md font-light text-gray-600">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full p-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your password"
                        >
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex justify-between w-full py-4">
                        <div class="mr-24">
                            <input type="checkbox" name="remember" id="remember" class="mr-2">
                            <label for="remember" class="text-md font-light text-gray-600">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-semibold text-blue-600 hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        LOG IN
                    </button>
                </form>

                <!-- Link to Register -->
                @if (Route::has('register'))
                <div class="text-center text-gray-500 mt-8">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:underline">Sign up now</a>
                </div>
                @endif
            </div>

            <!-- Right Side: Image -->
            <div class="relative">
                <img
                    src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80"
                    alt="A bright, modern living room"
                    class="w-[400px] h-full hidden md:block object-cover rounded-r-2xl"
                />
                <!-- Gradient overlay to make text pop -->
                <div class="absolute hidden md:block inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-r-2xl"></div>
            </div>

        </div>
    </div>

</body>
</html>