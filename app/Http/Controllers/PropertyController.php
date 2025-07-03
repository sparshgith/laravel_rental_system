<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // This is required for deleting files

class PropertyController extends Controller
{
    /**
     * Display the public listing of all available properties for tenants.
     * This powers your "Listed Properties" page.
     */
    public function publicIndex()
    {
        // Using the 'available' scope from the model is a clean way to do this.
        // If you haven't added the scope, `Property::where('is_occupied', false)` also works.
        $properties = Property::available()->latest()->get();
        return view('properties.public-index', compact('properties'));
    }

    /**
     * Display the admin's list of properties and the form to add a new one.
     * This powers your "Properties" admin page.
     */
    public function index()
    {
        $properties = Property::latest()->get();
        // This view contains both the "Add New Property" form and the "Existing Listings" table.
        return view('properties.index', compact('properties'));
    }

    /**
     * Store a newly created property in storage.
     * This handles the submission of the "Add New Property" form.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_type'   => 'required|string',
            'main_image'      => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location'        => 'required|string|max:255',
            'number_of_rooms' => 'required|integer|min:1',
            'address'         => 'required|string',
            'furnish_status'  => 'required|string',
            'monthly_rent'    => 'required|numeric|min:0',
        ]);

        // Store the uploaded image in 'storage/app/public/properties'
        $imagePath = $request->file('main_image')->store('properties', 'public');

        // Create the new property record in the database
        Property::create([
            'property_type'   => $validated['property_type'],
            'image_url'      => $imagePath,
            'location'        => $validated['location'],
            'number_of_rooms' => $validated['number_of_rooms'],
            'address'         => $validated['address'],
            'furnish_status'  => $validated['furnish_status'],
            'monthly_rent'    => $validated['monthly_rent'],
        ]);

        return redirect()->route('properties.index')->with('success', 'Property added successfully!');
    }

    /**
     * Remove the specified property from storage.
     * This is called when the "Delete" button is clicked in the admin panel.
     */
   public function destroy(Property $property)
{
    // Now it uses the correct column name
    if ($property->image_url) {
        Storage::disk('public')->delete($property->image_url);
    }

    $property->delete();

    return redirect()->route('properties.index')->with('success', 'Property deleted successfully!');
}

    // You can add show(), edit(), and update() methods here later for full CRUD functionality.
}
