<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validatedData = $request->validate([
            'property_type' => 'required|string',
            'location' => 'required|string|max:255',
            'address' => 'required|string',
            'furnish_status' => 'required|string',
            'number_of_rooms' => 'required|integer|min:1',
            'monthly_rent' => 'required|numeric|min:0',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('main_image')->store('properties', 'public');

        // Prepare the complete data array for saving
        $dataToSave = [
            'name' => $validatedData['furnish_status'] . ' ' . $validatedData['property_type'],
            'address' => $validatedData['address'],
            'property_type' => $validatedData['property_type'],
            'location' => $validatedData['location'],
            'number_of_rooms' => $validatedData['number_of_rooms'],
            'furnish_status' => $validatedData['furnish_status'],
            'monthly_rent' => $validatedData['monthly_rent'],
            'image_url' => $imagePath, // <-- ENSURE THIS LINE IS PRESENT
        ];

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
        $validatedData = $request->validate([
            'property_type' => 'required|string',
            'location' => 'required|string|max:255',
            'address' => 'required|string',
            'furnish_status' => 'required|string',
            'number_of_rooms' => 'required|integer|min:1',
            'monthly_rent' => 'required|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $dataToUpdate = $validatedData;

        if ($request->hasFile('main_image')) {
            if ($property->image_url) {
                Storage::disk('public')->delete($property->image_url);
            }
            $imagePath = $request->file('main_image')->store('properties', 'public');
            $dataToUpdate['image_url'] = $imagePath; // <-- ENSURE THIS LINE IS PRESENT
        }
        
        $dataToUpdate['name'] = $validatedData['furnish_status'] . ' ' . $validatedData['property_type'];

        $property->update($dataToUpdate);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        if ($property->image_url) {
            Storage::disk('public')->delete($property->image_url);
        }
        
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}