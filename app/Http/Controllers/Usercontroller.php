<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User2;

class Usercontroller extends Controller
{
    public function index(){
        return view('users.userinfo',['path' => 'info']);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pic = $request->file('pic')->storeAs(
            'avatar', $request->user()->id
        );
        $user = User2::find($request->input('id'));

        $user->profile_photo_path = $pic;

        $user->save();

        return redirect()->route('userinfo.index')->with('success', '프로필 사진이 수정되었습니다');
    }
}
