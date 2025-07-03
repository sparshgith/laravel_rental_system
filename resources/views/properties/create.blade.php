<!-- resources/views/properties/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- This page is in the admin area, so it should be called "Add New Property" --}}
            Add New Property
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    <!-- IMPORTANT: Added enctype for file uploads -->
                    <form method="POST" action="{{ route('properties.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Property Type (Dropdown) -->
                            <div>
                                <x-input-label for="property_type" :value="__('Property Type')" />
                                <select id="property_type" name="property_type" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Select a type</option>
                                    <option value="Apartment" @selected(old('property_type') == 'Apartment')>Apartment</option>
                                    <option value="House" @selected(old('property_type') == 'House')>House</option>
                                    <option value="Villa" @selected(old('property_type') == 'Villa')>Villa</option>
                                    <option value="Commercial" @selected(old('property_type') == 'Commercial')>Commercial</option>
                                </select>
                                <x-input-error :messages="$errors->get('property_type')" class="mt-2" />
                            </div>

                            <!-- Main Image (File Upload) -->
                            <div>
                                <x-input-label for="image_url" :value="__('Main Image')" />
                                <input id="image_url" name="image_url" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100" type="file" required />
                                <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="mt-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required placeholder="e.g. Downtown, Suburbia" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Full Address')" />
                            <textarea id="address" name="address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('address') }}</textarea>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                            <!-- Number of Rooms -->
                            <div>
                                <x-input-label for="number_of_rooms" :value="__('Number of Rooms')" />
                                <x-text-input id="number_of_rooms" class="block mt-1 w-full" type="number" name="number_of_rooms" :value="old('number_of_rooms')" required />
                                <x-input-error :messages="$errors->get('number_of_rooms')" class="mt-2" />
                            </div>

                            <!-- Furnish Status (Dropdown) -->
                            <div>
                                <x-input-label for="furnish_status" :value="__('Furnish Status')" />
                                <select id="furnish_status" name="furnish_status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Select status</option>
                                    <option value="Furnished" @selected(old('furnish_status') == 'Furnished')>Furnished</option>
                                    <option value="Semi-Furnished" @selected(old('furnish_status') == 'Semi-Furnished')>Semi-Furnished</option>
                                    <option value="Unfurnished" @selected(old('furnish_status') == 'Unfurnished')>Unfurnished</option>
                                </select>
                                <x-input-error :messages="$errors->get('furnish_status')" class="mt-2" />
                            </div>

                            <!-- Monthly Rent -->
                            <div>
                                <x-input-label for="monthly_rent" :value="__('Monthly Rent (Rs.)')" />
                                <x-text-input id="monthly_rent" class="block mt-1 w-full" type="number" name="monthly_rent" :value="old('monthly_rent')" required />
                                <x-input-error :messages="$errors->get('monthly_rent')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Create Property') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
