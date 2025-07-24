<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Register - {{ config('app.name', 'House Rental') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Styles for Registration Page (Two-Column Layout) -->
        <style>
            body {
                background-color: #f3f4f6 !important; /* Light gray background */
                font-family: 'Figtree', sans-serif;
            }
            .auth-container {
                display: flex;
                min-height: 100vh;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }
            .auth-card {
                display: flex;
                width: 100%;
                max-width: 960px; /* Wider card for two columns */
                background-color: #ffffff;
                border-radius: 24px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                overflow: hidden; /* This is crucial for the image's rounded corners */
            }
            .auth-form-panel {
                flex-basis: 55%; /* Form takes up more than half the space */
                padding: 3rem 4rem;
            }
            .auth-image-panel {
                flex-basis: 45%; /* Image takes up the rest */
                background-size: cover;
                background-position: center;
                /* --- Your specific image is loaded from this URL --- */
                background-image: url('https://i.postimg.cc/B6p7QfC3/modern-living-room.jpg');
            }
            .form-title {
                font-weight: 700;
                font-size: 1.875rem; /* text-3xl */
                color: #111827;
            }
            .form-subtitle {
                color: #6b7280;
                margin-top: 0.5rem;
            }
            .form-label {
                color: #374151;
                font-size: 0.875rem;
                margin-bottom: 0.5rem;
                font-weight: 500;
            }
            .form-control {
                border-radius: 8px;
                border: 1px solid #d1d5db;
                padding: 0.75rem 1rem;
                transition: border-color 0.2s, box-shadow 0.2s;
                background-color: #f9fafb;
            }
            .form-control:focus {
                border-color: #2563eb;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
                background-color: #ffffff;
                outline: none;
            }
            .btn-primary {
                background-color: #2563eb;
                color: white;
                font-weight: 600;
                padding: 0.8rem 1.5rem;
                border-radius: 8px;
                transition: background-color 0.2s;
                width: 100%;
                border: none;
                margin-top: 0.5rem;
            }
            .btn-primary:hover {
                background-color: #1d4ed8;
            }
            .auth-link-container {
                font-size: 0.875rem;
                color: #4b5563;
            }
            .auth-link {
                color: #2563eb;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s;
            }
            .auth-link:hover {
                text-decoration: underline;
            }
            /* Responsive Design for mobile */
            @media (max-width: 768px) {
                .auth-image-panel {
                    display: none; /* Hide the image on small screens */
                }
                .auth-form-panel {
                    flex-basis: 100%;
                    padding: 2.5rem;
                }
                .auth-card {
                     max-width: 480px;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-container">
            <div class="auth-card">

                <!-- Form Panel (Left) -->
                <div class="auth-form-panel">
                    <div class="mb-8">
                        <h2 class="form-title">Create an Account</h2>
                        <p class="form-subtitle">Let's get you set up to find your next property.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block form-label">{{ __('Full Name') }}</label>
                            <input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <label for="email" class="block form-label">{{ __('Email Address') }}</label>
                            <input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <label for="password" class="block form-label">{{ __('Password') }}</label>
                            <input id="password" class="block mt-1 w-full form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label for="password_confirmation" class="block form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" class="block mt-1 w-full form-control"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Register Button -->
                         <div class="mt-6">
                            <button type="submit" class="btn-primary">
                                {{ __('Sign Up') }}
                            </button>
                        </div>

                        <div class="text-center mt-6 auth-link-container">
                            Already have an account?
                            <a class="auth-link" href="{{ route('login') }}">
                                {{ __('Sign In') }}
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Image Panel (Right) -->
                <div class="auth-image-panel" style="background-image: url('{{ asset('images/90f2e480-bf35-4ad8-b59e-b41244839779.jpeg') }}');">
                    <!-- The background image is added via CSS -->
                </div>
            </div>
        </div>
    </body>
</html>