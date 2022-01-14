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
        //유효성 검사
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //정보 기억하기 클릭시 DB에 remember_token에 저장하기위한 변수저장
        $remember = $request->input('remember');

        //로그인기능 attempt()1번째 인자에 회원정보, 2번째 인자에 remember_token에 정보가 들어갈이 true/false로 판단
        if (Auth::attempt($validatedData, $remember)) {
            //화면에 alert.blade.php에 세션으로 success인지 error인지 전달
            return redirect()->route('main')->with('success', '로그인 되었습니다 어서오십시요');
        }
        else{
            return redirect()->back()->with('error', '회원정보가 일치하지 않습니다!!');
        }
    }
    //로그아웃
    public function logout()
    {
        Auth::logout();

        return redirect(route('main'));
    }
}
