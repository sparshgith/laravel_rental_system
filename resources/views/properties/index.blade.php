<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Properties</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Properties</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add New Property Form -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-8" style="background-color: #2D3748;">
        <h2 class="text-2xl font-bold text-white mb-6">Add New Property</h2>

        <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="property_type" class="block text-sm font-medium text-gray-300">Property Type</label>
                    <select name="property_type" id="property_type" required class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm">
                        <option value="">Select a type</option>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Villa">Villa</option>
                    </select>
                </div>
                <div>
                    <label for="main_image" class="block text-sm font-medium text-gray-300">Main Image</label>
                    <input type="file" name="main_image" id="main_image" required class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-600 file:text-gray-300">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-300">Location</label>
                    <input type="text" name="location" id="location" placeholder="e.g. Downtown" required class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm">
                </div>
                <div>
                    <label for="number_of_rooms" class="block text-sm font-medium text-gray-300">Number of Rooms</label>
                    <input type="number" name="number_of_rooms" id="number_of_rooms" placeholder="e.g. 3" required class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-300">Address</label>
                    <textarea name="address" id="address" rows="3" placeholder="e.g. 123 Main St, Anytown" required class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm"></textarea>
                </div>
                <div>
                    <label for="furnish_status" class="block text-sm font-medium text-gray-300">Furnish Status</label>
                    <select name="furnish_status" id="furnish_status" required class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm">
                        <option value="">Select status</option>
                        <option value="Furnished">Furnished</option>
                        <option value="Semi-Furnished">Semi-Furnished</option>
                        <option value="Unfurnished">Unfurnished</option>
                    </select>
                </div>
                <div>
                    <label for="monthly_rent" class="block text-sm font-medium text-gray-300">Monthly Rent (Rs.)</label>
                    <input type="number" name="monthly_rent" id="monthly_rent" placeholder="e.g. 50000" required class="mt-1 block w-full bg-gray-700 border-gray-600 text-white rounded-md shadow-sm">
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md">Submit Property</button>
            </div>
        </form>
    </div>

    <!-- Existing Listings -->
    <div class="bg-white rounded-lg shadow-lg p-8 mt-8" style="background-color: #2D3748;">
        <h2 class="text-2xl font-bold text-white mb-6">Existing Listings</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-700 text-white">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-left">Location</th>
                        <th class="py-3 px-4 text-left">Rent (Rs.)</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($properties as $property)
                        <tr class="border-b border-gray-600 hover:bg-gray-600">
                            <td class="py-3 px-4">
                                <img src="{{ asset('storage/' . $property->main_image) }}" alt="Property Image" class="h-16 w-24 object-cover rounded-md">
                            </td>
                            <td class="py-3 px-4">{{ $property->location }}</td>
                            <td class="py-3 px-4">{{ number_format($property->monthly_rent) }}</td>
                            <td class="py-3 px-4">
                                @if($property->is_occupied)
                                    <span class="bg-yellow-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Occupied</span>
                                @else
                                    <span class="bg-green-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Available</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-4 text-center text-gray-400">
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
