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
        ->with('organization');
        return $data;
    }

}
