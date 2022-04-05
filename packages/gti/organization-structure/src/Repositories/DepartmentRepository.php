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
        ->leftJoin('divisions','departments.division_id', '=', 'divisions.id')
        ->select(['departments.*', 'divisions.name as division_name']);

        if (isset($request->status)) {
            # code...
            $data->where('status', $request->status );
        }

        if (isset($request->name)) {
            # code...
            $data->where('name', 'LIKE', '%'.$request->name.'%' );
        }
        return $data;
    }

    public function getById($id)
    {
        # code...
        $data = $this->model
        ->where('departments.id', $id)
        ->leftJoin('divisions','departments.division_id', '=', 'divisions.id')
        ->get(['departments.*', 'divisions.name as division_name'])->last();
        return $data;
    }

}
