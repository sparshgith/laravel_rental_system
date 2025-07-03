<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Lease') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('leases.store') }}">
                        @csrf

                        <!-- Property Selection -->
                        <div>
                            <x-input-label for="property_id" :value="__('Property')" />
                            <select id="property_id" name="property_id" required class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">-- Select an Available Property --</option>
                                
                                {{-- 
                                    HERE IS THE CORRECTLY CLOSED @if BLOCK.
                                    It checks if there are any properties. If so, it loops through them.
                                    If not, it shows a disabled option. The @endif at the end closes it.
                                --}}
                                @if($properties->count() > 0)
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                            {{ $property->name }} ({{ $property->address }})
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No available properties to lease</option>
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('property_id')" class="mt-2" />
                        </div>

                        <!-- Tenant Selection -->
                        <div class="mt-4">
                            <x-input-label for="tenant_id" :value="__('Tenant')" />
                            <select id="tenant_id" name="tenant_id" required class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">-- Select Tenant --</option>
                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                        {{ $tenant->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tenant_id')" class="mt-2" />
                        </div>

                        <!-- Start Date -->
                        <div class="mt-4">
                            <x-input-label for="start_date" :value="__('Start Date')" />
                            <x-text-input id="start_date" type="date" name="start_date" :value="old('start_date')" required class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>

                        <!-- End Date -->
                        <div class="mt-4">
                            <x-input-label for="end_date" :value="__('End Date')" />
                            <x-text-input id="end_date" type="date" name="end_date" :value="old('end_date')" required class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>

                        <!-- Monthly Rent -->
                        <div class="mt-4">
                            <x-input-label for="monthly_rent" :value="__('Monthly Rent ($)')" />
                            <x-text-input id="monthly_rent" type="number" step="0.01" name="monthly_rent" :value="old('monthly_rent')" required class="block mt-1 w-full" />
                            <x-input-error :messages="$errors->get('monthly_rent')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Create Lease') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>