<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserVerifyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() 
    {
        return view('auth.login');
    }

    public function loginverify(UserVerifyRequest $request) : RedirectResponse
    {
        $data = $request->validated();


        if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'role'=> 'admin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }else if(Auth::guard('petugas')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'role'=> 'petugas'])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/petugas');
        }else if(Auth::guard('pimpinan')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'role'=> 'pimpinan'])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/pimpinan');
        }else if(Auth::guard('konsumen')->attempt(['email'=>$data['email'], 'password'=>$data['password'], 'role'=> 'konsumen'])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/konsumen');
        } else {
            return redirect()->route('login')->with('msg', 'email dan passord salah');    
        }
    }

    public function logout() : RedirectResponse
    {
        $guards = ['admin', 'petugas', 'pimpinan', 'konsumen'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break; // Hentikan loop setelah berhasil logout
            }
        }

        return redirect()->route('login');;
    }
}
