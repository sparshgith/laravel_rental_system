@extends('adminlte::page')

@section('title', 'Add New Tenant')

@section('content_header')
    <h1>Add New Tenant</h1>
@stop

@section('content')
<x-adminlte-card theme="success" theme-mode="outline" title="Tenant Details">
    <form action="{{ route('admin.tenants.store') }}" method="POST">
        @csrf
        <x-adminlte-input name="full_name" label="Full Name" placeholder="e.g., John Doe" required/>
        <x-adminlte-input name="email" type="email" label="Email Address" placeholder="e.g., john.doe@example.com" required/>
        <x-adminlte-input name="phone_number" label="Phone Number" placeholder="e.g., 9876543210" required/>
        <hr>
        <x-adminlte-button type="submit" label="Save Tenant" theme="success" icon="fas fa-save"/>
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop