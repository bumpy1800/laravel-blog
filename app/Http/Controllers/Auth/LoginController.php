<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User2;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    public function index()
    {
        return view('users.login', ['path' => 'login']);
    }
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //dd($request);
        $remember = $request->input('remember');

        if (Auth::attempt($validatedData, $remember)) {

            return redirect()->route('main')->with('success', '로그인 되었습니다 어서오십시요');
        }
        else{
            return redirect()->back()->with('error', '회원정보가 일치하지 않습니다!!');
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect(route('main'));
    }
}
