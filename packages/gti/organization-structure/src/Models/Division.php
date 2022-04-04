<?php

namespace GTI\OrganizationStructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $connection = 'mysql_master';
    protected $fillable = [
        'name',
        'organization_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function organization()
    {
        # code...
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
