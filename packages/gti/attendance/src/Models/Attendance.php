<?php

namespace GTI\Attendance\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql';
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

    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id');
    }
}
