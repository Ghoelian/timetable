<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        if (!\Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
            return back()->withErrors('Invalid credentials.');
        }

        return redirect(route('home'));
    }

    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $user = new User();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect(route('home'));
    }

    public function logout()
    {
        \Auth::logout();

        return redirect(route('login'));
    }
}
