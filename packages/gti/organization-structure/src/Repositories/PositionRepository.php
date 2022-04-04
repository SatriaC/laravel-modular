<?php

namespace GTI\OrganizationStructure\Repositories;

use App\Repositories\BaseRepository;
use GTI\OrganizationStructure\Models\Position;

class PositionRepository extends BaseRepository
{
    public function __construct(Position $model)
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
