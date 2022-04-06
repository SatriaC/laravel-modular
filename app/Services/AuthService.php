<?php

namespace App\Services;

use App\Models\Employees\Employee;
use App\Models\User\User;
use Illuminate\Support\Str;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService extends BaseService
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login($request)
    {
        $item = Employee::where('nip', $request->nip)->orderBy('created_at', 'desc')->first();
        if (Auth::attempt(['email' => $item->user->email, 'password' => $request->password])) {
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

    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' => 'logout_success'], 200);
        } else {
            return response()->json(['error' => 'api.something_went_wrong'], 500);
        }
    }

    public function forgot($request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status)
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    public function reset($request)
    {
        # code...
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);
    }
}
