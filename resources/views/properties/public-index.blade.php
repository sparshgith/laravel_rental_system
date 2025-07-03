<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listed Properties</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="relative h-96 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=2070');">
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
            <h1 class="text-5xl font-bold text-white tracking-wider">Listed Properties</h1>
        </div>
    </div>

    <div class="relative px-4">
        <div class="max-w-4xl mx-auto bg-white p-4 rounded-lg shadow-lg -mt-16">
            {{-- Search Bar Here --}}
        </div>
    </div>

    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse ($properties as $property)
                <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $property->main_image) }}" alt="{{ $property->property_type }} in {{ $property->location }}" class="w-full h-56 object-cover">
                    </div>
                    <div class="p-5">
                        <p class="font-bold text-xl text-gray-800">Rs. {{ number_format($property->monthly_rent) }}/month</p>
                        <h3 class="font-semibold text-lg mt-2 text-gray-900">{{ $property->property_type }} for Rent in {{ $property->location }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ $property->address }}</p>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200">
                            <span class="text-gray-700">{{ $property->number_of_rooms }} Rooms</span>
                            <span class="text-gray-700">{{ $property->furnish_status }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-500 text-lg">No properties found at the moment.</p>
                </div>
            @endforelse

        </div>
    </main>

</body>
</html>
