<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_type',
        'image_url', // This stores the relative path, e.g., 'properties/image.jpg'
        'location',
        'address',
        'furnish_status',
        'number_of_rooms',
        'monthly_rent',
        'is_occupied',
    ];

    /**
     * MODIFICATION 1: Attribute Casting
     * The attributes that should be cast to native types.
     * This ensures data is always in the correct format.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_occupied' => 'boolean',
        'monthly_rent' => 'decimal:2',
        'number_of_rooms' => 'integer',
    ];

    /**
     * MODIFICATION 2: Image URL Accessor
     * Get the full, public URL for the property's main image.
     * This creates a new "virtual" attribute called `$property->main_image_url`.
     */
    protected function mainImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->main_image ? Storage::url($this->main_image) : asset('images/default-property.png'),
        );
    }

    /**
     * MODIFICATION 3: Query Scope
     * Scope a query to only include available (unoccupied) properties.
     * This lets you write `Property::available()->get()` in your controller.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_occupied', false);
    }

    /**
     * A property can have many leases over time.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leases()
    {
        return $this->hasMany(Lease::class);
    }
}
