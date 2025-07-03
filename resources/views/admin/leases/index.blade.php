@extends('adminlte::page')

@section('title', 'Manage Leases')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Leases</h1>
        <a href="{{ route('admin.leases.create') }}" class="btn btn-primary">Add New Lease</a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-card title="Lease List" theme="warning" theme-mode="outline" collapsible>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Tenant</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Monthly Rent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leases as $lease)
                    <tr>
                        <td>{{ $lease->property->name ?? 'N/A' }}</td>
                        <td>{{ $lease->tenant->full_name ?? 'N/A' }}</td>
                        <td>{{ $lease->start_date }}</td>
                        <td>{{ $lease->end_date }}</td>
                        <td>Rs. {{ number_format($lease->monthly_rent) }}</td>
                        <td>
                            {{-- A simple destroy button for leases --}}
                            <form action="{{ route('admin.leases.destroy', $lease->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to terminate this lease?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Terminate</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No active leases found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-adminlte-card>
@stop