<x-app-layout>
    <x-slot name="header">
        <h2>Edit Property</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('properties.update', $property->id) }}">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" value="{{ old('name', $property->name) }}" required autofocus class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <textarea id="address" name="address" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>{{ old('address', $property->address) }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="price_per_month" :value="__('Price Per Month ($)')" />
                    <x-text-input id="price_per_month" name="price_per_month" type="number" step="0.01" value="{{ old('price_per_month', $property->price_per_month) }}" required class="block mt-1 w-full" />
                    <x-input-error :messages="$errors->get('price_per_month')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">{{ old('description', $property->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>{{ __('Update Property') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
