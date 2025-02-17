<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Franchise;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'franchise_id',
        'action',
        'module',
        'description',
        'ip_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }
}
