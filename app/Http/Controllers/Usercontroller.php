<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User2;

use Image;

class Usercontroller extends Controller
{
    public function index(){
        return view('users.userinfo',[
            'path' => 'info',
            
        ]);
    }

    public function store(Request $request){

        if($request->hasfile('pic')){
            $validatedData = $request->validate([
                'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            $picname = $request->user()->id.'.'.$request->file('pic')->extension();
            // 파일을 저장하고 그 경로를 반환(storeAs 2번째 인자는 파일 이름 설정)
            $picpath = $request->file('pic')->storeAs(
                'public/avatar', $picname
            );
            
            //저장하는 경로와 웹에서 접근가능한 경로가 달라서 저장위치와 db에 저장될 파일경로는 다르게 해줌
            $pic = 'storage/avatar/'.$picname;
            //dd($picpath);

            $user = User2::find($request->input('id'));

            $user->profile_photo_path = Crypt::encryptString($pic);

            $user->save();

            return redirect()->route('userinfo.index')->with('success', '회원 정보가 수정되었습니다.');
        }
        elseif(!$request->hasfile('pic')){
            return redirect()->back()->with('error', '사진을 선택해주세요.');
        }
       
    }
    public function picDelete(){

        $user = User2::find(Auth::user()->id);

        $user->profile_photo_path = null;

        $user->save();

        return redirect()->route('userinfo.index')->with('success', '사진이 제거되었습니다.');
    }
}
