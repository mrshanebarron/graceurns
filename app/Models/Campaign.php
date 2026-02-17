<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressPercentAttribute(): float
    {
        if ($this->goal_amount <= 0) return 0;
        return min(100, round(($this->raised_amount / $this->goal_amount) * 100, 1));
    }

    public function getDonorCountAttribute(): int
    {
        return $this->donations()->count();
    }
}
