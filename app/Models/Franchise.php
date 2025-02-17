<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FranchiseRequirement;
use App\Models\Staff;

class Franchise extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch',
        'location',
        'franchisee_name',
        'contact_number',
        'variant',
        'franchise_date',
        'status',
    ];

    public function requirements()
    {
        return $this->hasOne(FranchiseRequirement::class, 'franchise_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'franchise_id');
    }

}
