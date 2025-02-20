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
        'end_of_contract',
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

    public function activity_logs()
    {
        return $this->hasMany(ActivityLog::class, 'franchise_id');
    }

    public function qmtSchedules()
    {
        return $this->hasMany(QmtSchedule::class, 'franchise_id');
    }


}
