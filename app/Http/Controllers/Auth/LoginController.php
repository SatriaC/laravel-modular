<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public $successStatus = 200;

    protected $service;

    public function __construct(
        AuthService $service
    ) {
        $this->service = $service;
    }

    public function login(AuthRequest $request)
    {
        return $this->service->login($request);
    }
}
