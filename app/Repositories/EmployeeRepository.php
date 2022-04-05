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

    public function index($request)
    {
        # code...
        $data = $this->model
        ->orderBy('created_at', 'desc')
        ->select(['employees.*']);

        if (isset($request->name)) {
            # code...
            $data->where('name', 'LIKE', '%'.$request->name.'%' );
        }

        if (isset($request->phone)) {
            # code...
            $data->where('phone', $request->phone );
        }

        if (isset($request->nip)) {
            # code...
            $data->where('nip', $request->nip );
        }

        if (isset($request->status)) {
            # code...
            $data->where('status', $request->status );
        }

        if (isset($request->manager_id)) {
            # code...
            $data->where('manager_id', $request->manager_id );
        }

        return $data;
    }

    public function getById($id)
    {
        # code...
        $data = $this->model
        ->where('employees.id', $id)
        ->leftJoin(config('database.connections.mysql_master.database') .'.organizations','employees.organization', '=', 'organizations.id')
        ->leftJoin(config('database.connections.mysql_master.database') .'.divisions','employees.division', '=', 'divisions.id')
        ->leftJoin(config('database.connections.mysql_master.database') .'.departments','employees.department', '=', 'departments.id')
        ->leftJoin(config('database.connections.mysql_master.database') .'.positions','employees.position', '=', 'positions.id')
        ->get(['employees.*', 'organizations.name as organization_name', 'divisions.name as division_name',
         'departments.name as department_name', 'positions.name as position_name'])->last();
        return $data;
    }

}
