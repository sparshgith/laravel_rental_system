@extends('adminlte::page')

@section('title', 'Property Details')

@section('content_header')
    <h1>Property: {{ $property->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            {{-- Property Details Card --}}
            <x-adminlte-card title="Details" theme="lightblue" theme-mode="outline" collapsible>
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $property->image ?? 'https://via.placeholder.com/300' }}" class="img-fluid rounded" alt="Property Image">
                    </div>
                    <div class="col-md-8">
                        <dl>
                            <dt>Address</dt>
                            <dd>{{ $property->address }}</dd>
                            <dt>Description</dt>
                            <dd>{{ $property->description ?? 'N/A' }}</dd>
                            <dt>Price per Month</dt>
                            <dd>Rs. {{ number_format($property->price_per_month) }}</dd>
                            <dt>Status</dt>
                            <dd>
                                @if($property->is_occupied)
                                    <span class="badge badge-danger">Occupied</span>
                                @else
                                    <span class="badge badge-success">Available</span>
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
            </x-adminlte-card>
        </div>
        <div class="col-md-4">
            {{-- Actions Card --}}
            <x-adminlte-card title="Actions" theme="primary" theme-mode="outline">
                <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-block btn-info mb-2">Edit Property</a>
                @if(!$property->is_occupied)
                    <a href="{{ route('admin.leases.create', ['property_id' => $property->id]) }}" class="btn btn-block btn-success">Create New Lease</a>
                @endif
            </x-adminlte-card>
        </div>
    </div>

    {{-- Lease History Card --}}
    <x-adminlte-card title="Lease History" theme="warning" theme-mode="outline" collapsible>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tenant</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($property->leases as $lease)
                    <tr>
                        <td>{{ $lease->tenant->full_name }}</td>
                        <td>{{ $lease->start_date }}</td>
                        <td>{{ $lease->end_date }}</td>
                        <td>
                            @if(now()->between($lease->start_date, $lease->end_date))
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Expired</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">No lease history found for this property.</td></tr>
                @endforelse
            </tbody>
        </table>
    </x-adminlte-card>
@stop