<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email', // <-- Make sure this is present
        'phone_number',
        'address',
    ];

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }
}