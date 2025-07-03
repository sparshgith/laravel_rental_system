<x-app-layout>
    <x-slot name="header">
        <h2>Property Details</h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h3 class="text-xl font-bold mb-4">{{ $property->name }}</h3>

        <p><strong>Address:</strong> {{ $property->address }}</p>
        <p><strong>Description:</strong> {{ $property->description ?? 'N/A' }}</p>
        <p><strong>Price per Month:</strong> ${{ $property->price_per_month }}</p>

        <a href="{{ route('properties.edit', $property->id) }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</a>

        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
        </form>
    </div>
</x-app-layout>
