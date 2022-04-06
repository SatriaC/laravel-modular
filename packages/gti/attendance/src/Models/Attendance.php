<?php

namespace GTI\Attendance\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'start_at',
        'end_at',
        'duration',
        'image',
        'location',
        'latitude',
        'longitude',
        'location',
        'status',
        'approved_at',
        'approved_by',
        'reject_at',
        'reject_by',
        'reject_reason',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
