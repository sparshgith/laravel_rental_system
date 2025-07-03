<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tenant Details
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">

            <p><strong>Name:</strong> {{ $tenant->name }}</p>
            <p><strong>Email:</strong> {{ $tenant->email }}</p>
            <p><strong>Phone:</strong> {{ $tenant->phone }}</p>
            <p><strong>Address:</strong> {{ $tenant->address }}</p>

            <div class="mt-4">
                <a href="{{ route('tenants.edit', $tenant) }}" class="text-yellow-600 hover:text-yellow-900 mr-4">Edit</a>
                <form method="POST" action="{{ route('tenants.destroy', $tenant) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
