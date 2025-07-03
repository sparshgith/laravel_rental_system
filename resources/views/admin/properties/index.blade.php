@extends('adminlte::page')

@section('title', 'Manage Properties')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Properties</h1>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">Add New Property</a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-card title="Property List" theme="lightblue" theme-mode="outline" collapsible>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Price/Month</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($properties as $property)
                    <tr>
                        <td>
                            <img src="{{ $property->image ?? 'https://via.placeholder.com/80' }}" alt="property image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                        </td>
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->address }}</td>
                        <td>Rs. {{ number_format($property->price_per_month) }}</td>
                        <td>
                            @if($property->is_occupied)
                                <span class="badge badge-danger">Occupied</span>
                            @else
                                <span class="badge badge-success">Available</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{-- route('admin.properties.edit', $property->id) --}}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{-- route('admin.properties.destroy', $property->id) --}}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No properties found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $properties->links() }}
        </div>
    </x-adminlte-card>
@stop