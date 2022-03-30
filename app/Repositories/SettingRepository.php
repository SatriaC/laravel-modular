<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Models\User\User;
use App\Repositories\BaseRepository;

class SettingRepository extends BaseRepository
{
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
}
