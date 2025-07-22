@extends('adminlte::page')

@section('title', 'Add New Tenant')

@section('content_header')
    <h1>Add New Tenant</h1>
@stop

@section('content')
<x-adminlte-card theme="success" theme-mode="outline" title="Tenant Details">
    <form action="{{ route('admin.tenants.store') }}" method="POST">
        @csrf
        {{-- The `name` attribute here must be "full_name" --}}
        <x-adminlte-input name="full_name" label="Full Name" placeholder="e.g., John Doe" required error-key="full_name" value="{{ old('full_name') }}"/>
        
        {{-- The `name` attribute here must be "email" --}}
        <x-adminlte-input name="email" type="email" label="Email Address" placeholder="e.g., john.doe@example.com" required error-key="email" value="{{ old('email') }}"/>
        
        {{-- The `name` attribute here must be "phone_number" --}}
        <x-adminlte-input name="phone_number" label="Phone Number" placeholder="e.g., 9876543210" required error-key="phone_number" value="{{ old('phone_number') }}"/>
        <hr>
        <x-adminlte-button type="submit" label="Save Tenant" theme="success" icon="fas fa-save"/>
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop