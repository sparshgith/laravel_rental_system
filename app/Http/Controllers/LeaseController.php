<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    public function index()
    {
        // Eager load relationships to avoid N+1 problem
        $leases = Lease::with(['property', 'tenant'])->latest()->paginate(10);
        return view('leases.index', compact('leases'));
    }

    public function create()
    {
        // We only want to show properties that are not currently occupied
        $properties = Property::where('is_occupied', false)->get();
        $tenants = Tenant::all();
        return view('leases.create', compact('properties', 'tenants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tenant_id' => 'required|exists:tenants,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric|min:0',
        ]);

        // Create the lease
        Lease::create($request->all());

        // Mark the property as occupied
        $property = Property::find($request->property_id);
        $property->is_occupied = true;
        $property->save();

        return redirect()->route('leases.index')->with('success', 'Lease created successfully.');
    }

    public function destroy(Lease $lease)
    {
        // Mark the property as not occupied before deleting the lease
        $property = $lease->property;
        $property->is_occupied = false;
        $property->save();
        
        $lease->delete();

        return redirect()->route('leases.index')->with('success', 'Lease terminated successfully.');
    }
}