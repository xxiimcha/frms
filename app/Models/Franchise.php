<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch',
        'location',
        'franchisee_name',
        'contact_number',
        'variant',
        'franchise_date'
    ];

    public function requirements()
    {
        return $this->hasOne(FranchiseRequirement::class);
    }
}
