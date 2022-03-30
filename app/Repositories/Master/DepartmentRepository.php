<?php

namespace App\Repositories\Master;

use App\Models\Master\Department;
use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository
{
    public function __construct(Department $model)
    {
        $this->model = $model;
    }

}
