@extends('adminlte::page')

@section('title', 'Add New Property')

@section('content_header')
    <h1>Add New Property</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" title="Enter Property Details">
    {{-- Add enctype="multipart/form-data" for file uploads --}}
    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-adminlte-select name="property_type" label="Property Type" fgroup-class="col-md-6" error-key="property_type" required>
                <option value="" disabled {{ old('property_type') ? '' : 'selected' }}>Select a type...</option>
                <option value="Apartment" {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="House" {{ old('property_type') == 'House' ? 'selected' : '' }}>House</option>
                <option value="Studio" {{ old('property_type') == 'Studio' ? 'selected' : '' }}>Studio</option>
            </x-adminlte-select>

            <x-adminlte-input name="location" label="Location / Neighborhood" placeholder="e.g., Nadipur"
                fgroup-class="col-md-6" error-key="location" value="{{ old('location') }}" required/>
        </div>

        <div class="row">
             <x-adminlte-textarea name="address" label="Full Address" placeholder="Detailed address for the property"
                error-key="address">{{ old('address') }}</x-adminlte-textarea>
        </div>

        <div class="row">
            <x-adminlte-select name="furnish_status" label="Furnish Status" fgroup-class="col-md-4" error-key="furnish_status" required>
                <option value="" disabled {{ old('furnish_status') ? '' : 'selected' }}>Select a status...</option>
                <option value="Furnished" {{ old('furnish_status') == 'Furnished' ? 'selected' : '' }}>Furnished</option>
                <option value="Semi-Furnished" {{ old('furnish_status') == 'Semi-Furnished' ? 'selected' : '' }}>Semi-Furnished</option>
                <option value="Unfurnished" {{ old('furnish_status') == 'Unfurnished' ? 'selected' : '' }}>Unfurnished</option>
            </x-adminlte-select>

            <x-adminlte-input name="number_of_rooms" label="Number of Rooms" type="number"
                fgroup-class="col-md-4" error-key="number_of_rooms" value="{{ old('number_of_rooms') }}" required/>

            <x-adminlte-input name="monthly_rent" label="Monthly Rent (Rs.)" placeholder="e.g., 70000" type="number"
                fgroup-class="col-md-4" error-key="monthly_rent" value="{{ old('monthly_rent') }}" required/>
        </div>

        <div class="row">
            {{-- This is the file input component --}}
            <x-adminlte-input-file name="main_image" label="Main Image" placeholder="Choose an image..."
                fgroup-class="col-md-12" error-key="main_image" required/>
        </div>
        
        <hr>
        <x-adminlte-button type="submit" label="Save Property" theme="primary" icon="fas fa-save"/>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop