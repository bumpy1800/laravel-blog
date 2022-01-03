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

        $validatedData = $request->validate([
            'name' => 'required|unique:User2,name|max:100',
            'email' => 'required|unique:User2,email|email',
            'password' => 'required|max:255|min:8',
            'password_confirm' => 'required|same:password|min:8',
            'poliy' => 'required',
        ]);

        $name = $request['name'];
        $email = $request['email'];
        $password = Hash::make($request['password']);
        $profile_photo_path = null;

        user2::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'profile_photo_path' => $profile_photo_path,
        ]);
        return view("users.congratulations", ['path' => 'congratulations']);
    }
}
