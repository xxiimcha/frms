<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'franchise_id',
        'letter_of_intent',
        'resume',
        'market_study',
        'vicinity_map',
        'presentation_fee',
        'site_inspection',
        'battery_test',
        'valid_ids'
    ];

    protected $casts = [
        'valid_ids' => 'array'
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }
}
