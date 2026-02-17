<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function allocations()
    {
        return $this->hasMany(DonationAllocation::class);
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->is_anonymous ? 'Anonymous Donor' : $this->donor_name;
    }
}
