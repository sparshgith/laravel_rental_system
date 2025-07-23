@extends('adminlte::page')

@section('title', 'Edit Property')

@section('content_header')
    <h1>Edit Property: {{ $property->name }}</h1>
@stop

@section('content')
<x-adminlte-card theme="info" theme-mode="outline" title="Update Property Details">
    {{-- The form needs to point to the update route and handle file uploads --}}
    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- This tells Laravel to treat this as an UPDATE request --}}

        {{-- This block will display any validation errors --}}
        @if ($errors->any())
            <x-adminlte-alert theme="danger" title="Please correct the errors below">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-adminlte-alert>
        @endif

        <div class="row">
            <x-adminlte-select name="property_type" label="Property Type" fgroup-class="col-md-6" error-key="property_type" required>
                <option value="Apartment" {{ old('property_type', $property->property_type) == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="House" {{ old('property_type', $property->property_type) == 'House' ? 'selected' : '' }}>House</option>
                <option value="Studio" {{ old('property_type', $property->property_type) == 'Studio' ? 'selected' : '' }}>Studio</option>
            </x-adminlte-select>

            <x-adminlte-input name="location" label="Location / Neighborhood" value="{{ old('location', $property->location) }}"
                fgroup-class="col-md-6" error-key="location" required/>
        </div>

        <div class="row">
             <x-adminlte-textarea name="address" label="Full Address" error-key="address">{{ old('address', $property->address) }}</x-adminlte-textarea>
        </div>

        <div class="row">
            <x-adminlte-select name="furnish_status" label="Furnish Status" fgroup-class="col-md-4" error-key="furnish_status" required>
                <option value="Furnished" {{ old('furnish_status', $property->furnish_status) == 'Furnished' ? 'selected' : '' }}>Furnished</option>
                <option value="Semi-Furnished" {{ old('furnish_status', $property->furnish_status) == 'Semi-Furnished' ? 'selected' : '' }}>Semi-Furnished</option>
                <option value="Unfurnished" {{ old('furnish_status', $property->furnish_status) == 'Unfurnished' ? 'selected' : '' }}>Unfurnished</option>
            </x-adminlte-select>

            <x-adminlte-input name="number_of_rooms" label="Number of Rooms" value="{{ old('number_of_rooms', $property->number_of_rooms) }}" type="number"
                fgroup-class="col-md-4" error-key="number_of_rooms" required/>

            <x-adminlte-input name="monthly_rent" label="Monthly Rent (Rs.)" value="{{ old('monthly_rent', $property->monthly_rent) }}" type="number"
                fgroup-class="col-md-4" error-key="monthly_rent" required/>
        </div>

        <div class="row">
            <div class="col-md-9">
                {{-- The form field name is 'main_image' as defined in the controller --}}
                <x-adminlte-input-file name="main_image" label="Change Main Image (Optional)" placeholder="Choose a new image to replace the old one..."
                    fgroup-class="col-md-12" error-key="main_image"/>
            </div>
            <div class="col-md-3 text-center">
                <label>Current Image</label>
                {{-- This logic correctly displays the image using the 'image_url' column --}}
                @if($property->image_url)
                    <img src="{{ Storage::url($property->image_url) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-height: 100px;">
                @else
                    <p class="text-muted">No image uploaded.</p>
                @endif
            </div>
        </div>
        
        <hr>
        <x-adminlte-button type="submit" label="Update Property" theme="info" icon="fas fa-save"/>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop