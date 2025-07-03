@extends('adminlte::page')

@section('title', 'Edit Tenant')

@section('content_header')
    <h1>Edit Tenant: {{ $tenant->full_name }}</h1>
@stop

@section('content')
<x-adminlte-card theme="success" theme-mode="outline" title="Tenant Details">
    <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST">
        @csrf
        @method('PUT')
        <x-adminlte-input name="full_name" label="Full Name" value="{{ $tenant->full_name }}" required/>
        <x-adminlte-input name="email" type="email" label="Email Address" value="{{ $tenant->email }}" required/>
        <x-adminlte-input name="phone_number" label="Phone Number" value="{{ $tenant->phone_number }}" required/>
        <hr>
        <x-adminlte-button type="submit" label="Update Tenant" theme="success" icon="fas fa-save"/>
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</x-adminlte-card>
@stop