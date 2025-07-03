<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lease Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p><strong>Property:</strong> {{ $lease->property->name }}</p>
                    <p><strong>Tenant:</strong> {{ $lease->tenant->name }}</p>
                    <p><strong>Start Date:</strong> {{ $lease->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $lease->end_date }}</p>
                    <p><strong>Monthly Rent:</strong> ${{ $lease->monthly_rent }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
