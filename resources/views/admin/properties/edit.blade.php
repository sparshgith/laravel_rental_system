@extends('adminlte::page')

@section('title', 'Edit Property')

@section('content_header')
    <h1>Edit Property: {{ $property->name }}</h1>
@stop

@section('content')
<x-adminlte-card theme="primary" theme-mode="outline" title="Property Details">
    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- This is important for updates --}}
        
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="name" label="Property Name" value="{{ $property->name }}" fgroup-class="col-md-12" required/>
            </div>
            <div class="col-md-6">
                <x-adminlte-input name="address" label="Address" value="{{ $property->address }}" fgroup-class="col-md-12" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <x-adminlte-textarea name="description" label="Description">{{ $property->description }}</x-adminlte-textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input name="price_per_month" label="Price per Month (Rs.)" value="{{ $property->price_per_month }}" type="number" fgroup-class="col-md-12" required/>
            </div>
            <div class="col-md-6">
                <x-adminlte-input name="image" label="Image URL" value="{{ $property->image }}" fgroup-class="col-md-12"/>
            </div>
        </div>
        <hr>
        <x-adminlte-button type="submit" label="Update Property" theme="success" icon="fas fa-save"/>
        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop