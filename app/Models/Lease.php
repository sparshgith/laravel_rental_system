<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'tenant_id',
        'start_date',
        'end_date',
        'monthly_rent'
    ];

    // A lease belongs to one property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // A lease belongs to one tenant
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}