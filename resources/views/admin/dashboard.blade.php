@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to your rental management admin panel!</p>
    
    <div class="row">
        <div class="col-md-4">
            <x-adminlte-info-box title="Total Properties" text="{{ \App\Models\Property::count() }}" icon="fas fa-lg fa-building text-primary" theme="gradient-primary"/>
        </div>
        <div class="col-md-4">
            <x-adminlte-info-box title="Total Tenants" text="{{ \App\Models\Tenant::count() }}" icon="fas fa-lg fa-users text-success" theme="gradient-success"/>
        </div>
        <div class="col-md-4">
            <x-adminlte-info-box title="Active Leases" text="{{ \App\Models\Lease::count() }}" icon="fas fa-lg fa-file-signature text-warning" theme="gradient-warning"/>
        </div>
    </div>
@stop