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
        
        if (Auth::attempt($validatedData)) {

            return redirect()->route('main');
        }
        else{
            return redirect()->back();
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect(route('main'));
    }
}
