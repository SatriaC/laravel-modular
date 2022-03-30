<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $connection = 'mysql_master';
    protected $fillable = [
        'name',
        'status',
    ];
    public $timestamps = false;
}
