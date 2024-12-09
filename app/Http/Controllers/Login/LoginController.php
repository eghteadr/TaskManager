<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $role = Auth::user()->getRoleNames()->first();

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'supervisor':
                    return redirect()->route('supervisor.dashboard');
                case 'employee':
                    return redirect()->route('employee.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('/')->withErrors(['role' => 'نقش نامعتبر است.']);
            }
        }

        return redirect()->route('/')->withErrors([
            'email' => 'اطلاعات وارد شده صحیح نیست.',
        ])->withInput();
    }


}
