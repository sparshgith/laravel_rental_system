<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Property; // <-- ADD THIS: Import the Property model
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * MODIFIED: This method now fetches properties to display the public listing view
     * on the /tenants route.
     */
    public function index()
    {
        // OLD CODE (REMOVED): $tenants = Tenant::latest()->paginate(10);
        // NEW CODE: Fetch all properties instead of tenants.
        $properties = Property::latest()->get();

        // Return the view, now passing the '$properties' variable to it.
        return view('tenants.index', compact('properties'));
    }

    /**
     * The rest of the methods are left unchanged so you can still
     * manage tenants if you have separate forms for creating/editing them.
     */

    public function create()
    {
        return view('tenants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        Tenant::create($request->all());

        return redirect()->route('tenants.index')->with('success', 'Tenant created successfully.');
    }

    public function show(Tenant $tenant)
    {
        $tenant->load('leases.property');
        return view('tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email,' . $tenant->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $tenant->update($request->all());

        return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
