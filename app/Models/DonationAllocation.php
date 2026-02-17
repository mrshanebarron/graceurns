<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationAllocation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:2',
        'fulfilled_at' => 'date',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
