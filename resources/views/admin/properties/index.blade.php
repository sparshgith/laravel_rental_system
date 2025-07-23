@extends('adminlte::page')

@section('title', 'Manage Properties')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Properties</h1>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">Add New Property</a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <x-adminlte-card title="Property List" theme="lightblue" theme-mode="outline" collapsible>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 100px;">Image</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price/Month</th>
                        <th>Status</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($properties as $property)
                        <tr>
                            <td>
                                {{-- CORRECTED LOGIC using 'image_url' to match your database --}}
                                @if ($property->image_url)
                                    @if (filter_var($property->image_url, FILTER_VALIDATE_URL))
                                        {{-- If it's a full URL (from seeder), use it directly --}}
                                        <img src="{{ $property->image_url }}" alt="Property Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                    @else
                                        {{-- If it's a relative path (from upload), use Storage::url() --}}
                                        <img src="{{ Storage::url($property->image_url) }}" alt="Property Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                    @endif
                                @else
                                    {{-- Fallback for properties with no image at all --}}
                                    <img src="https://via.placeholder.com/80" alt="No Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                @endif
                            </td>
                            <td><a href="{{ route('admin.properties.show', $property->id) }}">{{ $property->name }}</a></td>
                            <td>{{ $property->location }}</td>
                            <td>Rs. {{ number_format($property->monthly_rent) }}</td>
                            <td>
                                @if($property->is_occupied)
                                    <span class="badge badge-danger">Occupied</span>
                                @else
                                    <span class="badge badge-success">Available</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No properties found. Add one to get started!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination links --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $properties->links() }}
        </div>
    </x-adminlte-card>
@stop