<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

   public function store(Request $request)
{
    // 1. Validation - this is correct
    $validatedData = $request->validate([
        'property_type' => 'required|string',
        'location' => 'required|string|max:255',
        'address' => 'required|string',
        'furnish_status' => 'required|string',
        'number_of_rooms' => 'required|integer|min:1',
        'monthly_rent' => 'required|numeric|min:0',
        'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 2. Image Upload - this is correct
    $imagePath = $request->file('main_image')->store('properties', 'public');

    // 3. Prepare Data - THIS IS THE SECTION TO FIX
    $dataToSave = [
        'name' => $validatedData['furnish_status'] . ' ' . $validatedData['property_type'],
        'address' => $validatedData['address'],
        'property_type' => $validatedData['property_type'],
        'location' => $validatedData['location'],
        'number_of_rooms' => $validatedData['number_of_rooms'],
        'furnish_status' => $validatedData['furnish_status'],
        'monthly_rent' => $validatedData['monthly_rent'],
        
        // Use the correct database column name here
        'image_url' => $imagePath, 
    ];

    // 4. Create Record - this will now work
    Property::create($dataToSave);

    return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');
}
    public function show(Property $property)
    {
        $property->load('leases.tenant');
        return view('admin.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        // Add update logic here later, similar to the store method
        // For now, let's focus on getting 'create' to work.
        // You would validate and then use $property->update($dataToUpdate);
        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}