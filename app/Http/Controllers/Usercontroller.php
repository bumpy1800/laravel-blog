<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User2;

class Usercontroller extends Controller
{
    public function index(){
        return view('users.userinfo',['path' => 'info']);
    }

    public function store(Request $request){

        if($request->hasfile('pic')){
            $validatedData = $request->validate([
                'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // 파일을 저장하고 그 경로를 반환(storeAs 2번째 인자는 파일 이름 설정)
            $pic = $request->file('pic')->storeAs(
                'avatar', $request->user()->id.'.'.$request->file('pic')->extension()
            );
            //dd($pic);
            $user = User2::find($request->input('id'));

            $user->profile_photo_path = Crypt::encryptString($pic);

            $user->save();
        }
        return redirect()->route('userinfo.index')->with('success', '회원 정보가 수정되었습니다.');
    }
}
