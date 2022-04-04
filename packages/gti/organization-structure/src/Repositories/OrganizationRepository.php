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
        return $data;
    }

}
