<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    // ... index() and create() methods are fine ...
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. UPDATE VALIDATION to include the image file
    $validatedData = $request->validate([
        'property_type' => 'required|string',
        'location' => 'required|string|max:255',
        'number_of_rooms' => 'required|integer',
        'address' => 'required|string',
        'furnish_status' => 'required|string',
        'price_per_month' => 'required|numeric',
        'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the uploaded file
    ]);

    // 2. Handle the file upload
    $imagePath = $request->file('main_image')->store('properties', 'public');

    // 3. Prepare data to match database column names
    $dataToSave = [
        'name' => $validatedData['furnish_status'] . ' ' . $validatedData['property_type'],
        'address' => $validatedData['address'],
        'property_type' => $validatedData['property_type'],
        'location' => $validatedData['location'],
        'number_of_rooms' => $validatedData['number_of_rooms'],
        'furnish_status' => $validatedData['furnish_status'],
        'price_per_month' => $validatedData['monthly_rent'],
        'main_image' => $imagePath,
    ];

    // 4. CREATE the property record
    Property::create($dataToSave);

    return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');
}
    
    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // 1. UPDATE VALIDATION for the edit form
        $validatedData = $request->validate([
            'property_type' => 'required|string',
            'location' => 'required|string|max:255',
            'number_of_rooms' => 'required|integer',
            'address' => 'required|string',
            'furnish_status' => 'required|string',
            'monthly_rent' => 'required|numeric',
            'main_image' => 'nullable|url|max:2048',
        ]);

        // 2. PREPARE DATA for the update
        $dataToUpdate = [
            'name' => $validatedData['furnish_status'] . ' ' . $validatedData['property_type'],
            'address' => $validatedData['address'],
            'property_type' => $validatedData['property_type'],
            'location' => $validatedData['location'],
            'number_of_rooms' => $validatedData['number_of_rooms'],
            'furnish_status' => $validatedData['furnish_status'],
            'price_per_month' => $validatedData['monthly_rent'],
            'main_image' => $validatedData['main_image'],
        ];

        // 3. UPDATE the property record
        $property->update($dataToUpdate);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}