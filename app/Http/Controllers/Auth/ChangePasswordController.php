<?php

namespace App\Http\Controllers\Auth_API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function change(AuthRequest $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::where('id', Auth::guard('api')->user()->id)->orderBy('id', 'desc')->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'status' => 200,
            'title' => 'success',
            'message' => 'Password Berhasil dirubah!'
        ]);

    }
}
