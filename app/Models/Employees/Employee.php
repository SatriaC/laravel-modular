<?php

namespace App\Models\Employees;

use App\Models\Master\Department;
use App\Models\Master\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $fillable = [
        'nip',
        'nik',
        'name',
        'gender',
        'birthdate',
        'birthplace',
        'address',
        'phone',
        'email',
        'organization',
        'division',
        'department',
        'position',
        'manager_id',
        'status',
        'start_at',
        'end_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function user()
    {
        # code...
        return $this->hasOne(User::class, 'employee_id');
    }

    public function department()
    {
        # code...
        return $this->belongsTo(Department::class, 'department');
    }

    public function position()
    {
        # code...
        return $this->belongsTo(Position::class, 'position');
    }
}
