<?php

namespace GTI\OrganizationStructure\Repositories;

use App\Repositories\BaseRepository;
use GTI\OrganizationStructure\Models\Division;

class DivisionRepository extends BaseRepository
{
    public function __construct(Division $model)
    {
        $this->model = $model;
    }

    public function index($request)
    {
        # code...
        $data = $this->model
        ->leftJoin('organizations','divisions.organization_id', '=', 'organizations.id')
        ->select(['divisions.*', 'organizations.name as organization_name']);

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
        ->where('divisions.id', $id)
        ->leftJoin('organizations','divisions.organization_id', '=', 'organizations.id')
        ->get(['divisions.*', 'organizations.name as organization_name'])->last();
        return $data;
    }

}
