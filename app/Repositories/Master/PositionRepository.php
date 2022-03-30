<?php

namespace App\Repositories\Master;

use App\Models\Master\Position;
use App\Repositories\BaseRepository;

class PositionRepository extends BaseRepository
{
    public function __construct(Position $model)
    {
        $this->model = $model;
    }

}
