<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Property Listings</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- Hero Section with Background Image -->
    <div class="relative h-96 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2070');">
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
            <h1 class="text-5xl font-bold text-white tracking-wider">Listed Properties</h1>
        </div>
    </div>

    <div class="relative px-4">
        <!-- Search Bar -->
        <div class="max-w-4xl mx-auto bg-white p-4 rounded-lg shadow-lg -mt-16">
            <div class="flex items-center space-x-4 mb-4">
                <button class="px-4 py-2 text-sm font-semibold border-b-2 border-yellow-500 text-gray-800">FOR RENT</button>
                <button class="px-4 py-2 text-sm font-semibold text-gray-500 hover:border-b-2 hover:border-gray-300">FOR SALE</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" placeholder="Search by Location, Project Name" class="w-full col-span-1 md:col-span-2 border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                <div class="flex space-x-2">
                    <select class="w-full border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500">
                        <option>Property Type</option>
                        <option>Apartment</option>
                        <option>House</option>
                    </select>
                    <button class="bg-yellow-500 text-white px-6 py-2 rounded-md font-semibold hover:bg-yellow-600">SEARCH</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Property Listings Grid -->
    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- This now correctly loops through the $properties variable sent from TenantController --}}
            @forelse ($properties as $property)
                <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $property->image_url) }}" alt="{{ $property->property_type }} in {{ $property->location }}" class="w-full h-56 object-cover">
                    </div>
                    <div class="p-5">
                        <p class="font-bold text-xl text-gray-800">Rs. {{ number_format($property->monthly_rent) }}/month</p>
                        <h3 class="font-semibold text-lg mt-2 text-gray-900">{{ $property->property_type }} for Rent in {{ $property->location }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $property->address }}</p>

                        <div class="flex items-center justify-start space-x-6 mt-4 pt-4 border-t border-gray-200">
                            <div class="flex items-center space-x-2 text-gray-700">
                                <!-- Bed Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M17.293 6.293a1 1 0 010 1.414L11 14.414V18a1 1 0 01-1 1H2a1 1 0 01-1-1v-5a1 1 0 011-1h6V8H3a1 1 0 110-2h4V3a1 1 0 011-1h4a1 1 0 011 1v3h4a1 1 0 011 1v1l-3.293-3.293a1 1 0 010-1.414z" /></svg>
                                <span>{{ $property->number_of_rooms }}</span>
                            </div>
                             <div class="flex items-center space-x-2 text-gray-700">
                                <!-- Bath Icon (placeholder, adjust if you have bath data) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1h-2.586l-1.707 1.707A1 1 0 0111 12V10H9v2a1 1 0 01-1.707.707L5.586 11H3a1 1 0 01-1-1V3zm0 2v3h14V5H3z" clip-rule="evenodd" /></svg>
                                <span>1</span> <!-- Placeholder for baths -->
                            </div>
                            <div class="flex items-center space-x-2 text-gray-700">
                                <!-- Furnish Status Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                                <span>{{ $property->furnish_status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">No properties found at the moment.</p>
            @endforelse
        </div>
    </main>

</body>
</html>
