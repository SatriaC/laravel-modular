<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $successStatus = 200;

    protected $service;

    public function __construct(
        UserService $service
    ) {
        $this->service = $service;
    }

    public function show()
    {
        return $this->service->show();
    }

    public function update(UpdateRequest $request)
    {
        return $this->service->update($request);
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        return $this->service->updatePassword($request);
    }
}
