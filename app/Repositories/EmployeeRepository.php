<?php

namespace App\Repositories;

use App\Models\Employees\Employee;
use App\Repositories\BaseRepository;

class EmployeeRepository extends BaseRepository
{
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

}
