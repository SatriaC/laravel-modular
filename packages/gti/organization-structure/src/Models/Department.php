<?php

namespace GTI\OrganizationStructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql_master';
    protected $fillable = [
        'name',
        'division_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function division()
    {
        # code...
        return $this->belongsTo(Division::class, 'division_id');
    }

}
