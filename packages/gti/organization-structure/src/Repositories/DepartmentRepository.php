<?php

namespace GTI\OrganizationStructure\Repositories;

use App\Repositories\BaseRepository;
use GTI\OrganizationStructure\Models\Department;

class DepartmentRepository extends BaseRepository
{
    public function __construct(Department $model)
    {
        $this->model = $model;
    }

    public function index($request)
    {
        # code...
        $data = $this->model
        ->with('division');
        return $data;
    }

}
