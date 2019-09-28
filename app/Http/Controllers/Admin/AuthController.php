<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->only('email', 'password');

        $user = User::where('email', $data['email'])
            ->with(['roles' => function ($query) {
                $query->where('name', Role::ROLE_ADMIN);
            }])
            ->first();

        if (!$user) {
            return redirect()->back()->withFlashDanger('Người dùng không tồn tại');
        }

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->back()->withFlashDanger('Mật khẩu không đúng');
        }

        return redirect()->route('admin');
    }
}
