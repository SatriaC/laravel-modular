<?php

namespace GTI\OrganizationStructure\Repositories;

use App\Repositories\BaseRepository;
use GTI\OrganizationStructure\Models\Organization;

class OrganizationRepository extends BaseRepository
{
    public function __construct(Organization $model)
    {
        $this->model = $model;
    }

    public function index($request)
    {
        # code...
        $data = $this->model;

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

}
