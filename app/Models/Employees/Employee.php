<?php

namespace App\Models\Employees;

use App\Models\Master\Department;
use App\Models\Master\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'nip',
        'name',
        'gender',
        'birthdate',
        'birthplace',
        'address',
        'phone',
        'email',
        'department_id',
        'position_id',
        'status',
        'has_married',
        'start_contract',
    ];

    public function department()
    {
        # code...
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function position()
    {
        # code...
        return $this->belongsTo(Position::class, 'position_id');
    }
}
