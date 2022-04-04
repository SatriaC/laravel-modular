<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $successStatus = 200;

    protected $service;

    public function __construct(
        AuthService $service
    ) {
        $this->service = $service;
    }

    public function login(Request $request)
    {
        return $this->service->login($request);
    }

    public function logout()
    {
        return $this->service->logout();
    }

    public function reset()
    {
        return $this->service->reset();
    }
}
