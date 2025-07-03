@extends('adminlte::page')

@section('title', 'Manage Tenants')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Tenants</h1>
        <a href="{{ route('admin.tenants.create') }}" class="btn btn-primary">Add New Tenant</a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <x-adminlte-card title="Tenant List" theme="success" theme-mode="outline" collapsible>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tenants as $tenant)
                    <tr>
                        <td>{{ $tenant->full_name }}</td>
                        <td>{{ $tenant->email }}</td>
                        <td>{{ $tenant->phone_number }}</td>
                        <td>
                            <a href="{{ route('admin.tenants.edit', $tenant->id) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No tenants found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $tenants->links() }}
        </div>
    </x-adminlte-card>
@stop