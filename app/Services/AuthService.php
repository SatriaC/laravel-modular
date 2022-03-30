<?php

namespace App\Services;

use App\Models\User\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login($request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $data['access_token'] = $user->createToken('nApp')->accessToken;
            // $permissions = array();
            // $dataPermissions = $user->getPermissionsViaRoles();

            // foreach ($dataPermissions as $item) {
            //     array_push($permissions, $item->name);
            // }

            // $data['permissions'] = $permissions;
            return $this->responseMessage('Login Success', 200, true, $data);
        } else {
            return response()->json(
                [
                    "message" => "These credentials do not match our records.",
                    "error" => "These credentials do not match our records."
                ],
                400
            );

        }
    }
}
