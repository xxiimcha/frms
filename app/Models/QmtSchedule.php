<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QmtSchedule extends Model
{
    use HasFactory;

    protected $table = 'qmt_schedules';

    protected $fillable = [
        'franchise_id',
        'year',
        'q1',
        'q2',
        'q3',
        'q4',
    ];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class, 'franchise_id');
    }
}
