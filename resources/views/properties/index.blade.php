<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Host With Us - Manage Properties</title>
    {{-- Using the Tailwind CSS CDN for simplicity --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

    <!-- NAVIGATION BAR -->
    <nav class="bg-[#033c6b] p-4 shadow-lg">
        <div class="container mx-auto">
            <a href="{{ url('/') }}" class="flex items-center text-white no-underline hover:opacity-90 transition-opacity">
                <!-- SVG Logo -->
                <svg class="h-8 w-8 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2.0996094L1 12L4 12L4 21L11 21L11 15L13 15L13 21L20 21L20 12L23 12L12 2.0996094z"/>
                </svg>
                <!-- Text -->
                <span class="font-semibold text-lg tracking-wider uppercase">RENTAL MANAGEMENT SYSTEM</span>
            </a>
        </div>
    </nav>
    <!-- END NAVIGATION BAR -->


    <!-- HERO BANNER SECTION -->
    <div class="relative h-[400px] w-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop');">

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-sky-400/70 via-sky-300/60 to-white"></div>

        <!-- Text Content -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center">
            <h1 class="text-6xl md:text-7xl font-bold text-slate-800" style="color: #2D3748;">
                Host With Us
            </h1>
            <p class="mt-4 text-lg text-slate-600" style="color: #4A5568;">
                Tell us about your property, and we'll take care of the rest!
            </p>
        </div>
    </div>
    <!-- END HERO BANNER SECTION -->


    {{-- The rest of your page content begins here --}}
    <div class="container mx-auto p-4 sm:p-8 -mt-16"> {{-- Negative margin pulls the content up slightly over the fade --}}

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Personal Information Title (now part of the form card) --}}

        <!-- Add New Property Card -->
        <div class="bg-white rounded-lg shadow-xl p-6 sm:p-8 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Personal Information</h2>

            <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Property Type --}}
                    <div>
                        <label for="property_type" class="block text-sm font-medium text-gray-700">Property Type</label>
                        <select name="property_type" id="property_type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select a type</option>
                            <option value="Apartment">Apartment</option>
                            <option value="House">House</option>
                            <option value="Villa">Villa</option>
                        </select>
                    </div>

                    {{-- Main Image --}}
                    <div>
                        <label for="main_image" class="block text-sm font-medium text-gray-700">Main Image</label>
                        <input type="file" name="main_image" id="main_image" required class="mt-1 block w-full text-sm text-gray-500 border border-gray-300 rounded-md cursor-pointer
                        file:mr-4 file:py-2 file:px-4 file:rounded-l-md
                        file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                    </div>

                    {{-- Location --}}
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="location" placeholder="e.g. Downtown" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Number of Rooms --}}
                    <div>
                        <label for="number_of_rooms" class="block text-sm font-medium text-gray-700">Number of Rooms</label>
                        <input type="number" name="number_of_rooms" id="number_of_rooms" placeholder="e.g. 3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address" id="address" rows="3" placeholder="e.g. 123 Main St, Anytown" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    {{-- Furnish Status --}}
                    <div>
                        <label for="furnish_status" class="block text-sm font-medium text-gray-700">Furnish Status</label>
                        <select name="furnish_status" id="furnish_status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select status</option>
                            <option value="Furnished">Furnished</option>
                            <option value="Semi-Furnished">Semi-Furnished</option>
                            <option value="Unfurnished">Unfurnished</option>
                        </select>
                    </div>

                    {{-- Monthly Rent --}}
                    <div>
                        <label for="monthly_rent" class="block text-sm font-medium text-gray-700">Monthly Rent (Rs.)</label>
                        <input type="number" name="monthly_rent" id="monthly_rent" placeholder="e.g. 50000" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-sm transition duration-150 ease-in-out">Submit Property</button>
                </div>
            </form>
        </div>

        <!-- Existing Listings Card (if you still need it) -->
        <div class="bg-white rounded-lg shadow-xl p-6 sm:p-8">
            <div class="flex items-center space-x-3 mb-4">
                <svg class="w-8 h-8 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" />
                </svg>
                <h2 class="text-2xl font-semibold text-gray-800">Existing Listings</h2>
            </div>

           <div class="overflow-x-auto">
    <table class="min-w-full">
        {{-- Light color table header --}}
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Image
                </th>
                <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Location
                </th>
                <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Rent (Rs.)
                </th>
                <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($properties as $property)
                <tr class="hover:bg-gray-50">
                    <td class="py-4 px-6">
                        <img src="{{ asset('storage/' . $property->main_image) }}" alt="Property Image" class="h-16 w-24 object-cover rounded-md">
                    </td>
                    <td class="py-4 px-6 text-sm text-gray-700">{{ $property->location }}</td>
                    <td class="py-4 px-6 text-sm text-gray-700">{{ number_format($property->monthly_rent) }}</td>
                    <td class="py-4 px-6">
                        @if($property->is_occupied)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Occupied
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Available
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <form action="{{ route('properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md text-xs">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-10 px-6 text-center text-gray-500">
                        No property listings found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
        </div>

    </div>

</body>
</html>