<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User2;

class RegisterController extends Controller
{   
    public function create(){
        return view("users.register", ['path' => 'register']);
    }

    public function store(Request $request){
        //값 유효성 검사
        $validatedData = $request->validate([
            'name' => 'required|unique:User2,name|max:100',
            'email' => 'required|unique:User2,email|email',
            'password' => 'required|max:255|min:8',
            'password_confirm' => 'required|same:password|min:8',
            'poliy' => 'required',
        ]);
        //엘로퀀트ORM이용해서 insert
        user2::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'profile_photo_path' => null,
        ]);
        //status변수를 이용해서 완료화면에서 탈퇴인지 가입인지 구분
        return view("users.congratulations", [
            'path' => 'congratulations',
            'status' => 'register',
        ]);
    }
}
