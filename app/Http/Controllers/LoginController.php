<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            'title' => 'Đăng Nhập Hệ Thống'
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

//dd(Auth::attempt([
//    'username' => $request->input('username'),
//    'password' => $request->input('password')
//]));

        if (Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ], $request->input('remember'))) {

            return redirect()->route('home');
        }

        Session::flash('error', 'Email hoặc Password không đúng');
        return redirect()->back();
    }
}
