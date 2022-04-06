<?php

namespace GTI\Attendance\Repositories;

use App\Repositories\BaseRepository;
use GTI\Attendance\Models\Attendance;

class AttendanceRepository extends BaseRepository
{
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

}
