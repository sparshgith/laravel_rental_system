@extends('adminlte::page')

@section('title', 'Add New Lease')

@section('content_header')
    <h1>Add New Lease</h1>
@stop

@section('content')
<x-adminlte-card theme="warning" theme-mode="outline" title="Lease Details">
    <form action="{{ route('admin.leases.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-select name="property_id" label="Property" required>
                    <option value="" disabled selected>Select an available property...</option>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}">{{ $property->name }} ({{ $property->address }})</option>
                    @endforeach
                </x-adminlte-select>
            </div>
            <div class="col-md-6">
                <x-adminlte-select name="tenant_id" label="Tenant" required>
                    <option value="" disabled selected>Select a tenant...</option>
                    @foreach($tenants as $tenant)
                        <option value="{{ $tenant->id }}">{{ $tenant->full_name }}</option>
                    @endforeach
                </x-adminlte-select>
            </div>
        </div>
        <div class="row">
             <div class="col-md-4">
                <x-adminlte-input name="start_date" type="date" label="Start Date" required/>
            </div>
             <div class="col-md-4">
                <x-adminlte-input name="end_date" type="date" label="End Date" required/>
            </div>
             <div class="col-md-4">
                <x-adminlte-input name="monthly_rent" label="Monthly Rent (Rs.)" type="number" required/>
            </div>
        </div>
        <hr>
        <x-adminlte-button type="submit" label="Create Lease" theme="primary" icon="fas fa-save"/>
        <a href="{{ route('admin.leases.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop