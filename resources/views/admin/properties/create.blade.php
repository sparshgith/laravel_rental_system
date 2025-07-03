@extends('adminlte::page')

@section('title', 'Add New Property')

@section('content_header')
    <h1>Add New Property</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" title="Property Details">
    <form action="{{ route('admin.properties.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="name" label="Property Name" placeholder="e.g., Sunnyvale Apartment" fgroup-class="col-md-12" required/>
            </div>
            <div class="col-md-6">
                <x-adminlte-input name="address" label="Address" placeholder="e.g., 123 Main St, Anytown" fgroup-class="col-md-12" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <x-adminlte-textarea name="description" label="Description" placeholder="Enter a brief description of the property..."/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="price_per_month" label="Price per Month (Rs.)" placeholder="e.g., 75000" type="number" fgroup-class="col-md-12" required/>
            </div>
            <div class="col-md-6">
                <x-adminlte-input name="image" label="Image URL" placeholder="https://example.com/image.jpg" fgroup-class="col-md-12"/>
            </div>
        </div>
        <hr>
        <x-adminlte-button type="submit" label="Save Property" theme="primary" icon="fas fa-save"/>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop