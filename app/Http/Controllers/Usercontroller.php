<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use App\Models\User2;

use Image;

class Usercontroller extends Controller
{
    //path변수로 무슨화면인지 판단
    public function show(){
        return view('users.userinfo',[
            'path' => 'info',
        ]);
    }

    public function store(Request $request){
        //파일이 입력되었을때만 작동
        if($request->hasfile('pic')){
            //유효성검사
            $validatedData = $request->validate([
                'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            //경로를 제외한 순수 파일명 1.jpg이런 형식
            $picname = $request->user()->id.'.'.$request->file('pic')->extension();
            // 파일을 저장하고 그 경로를 반환(storeAs 2번째 인자는 파일 이름 설정)
            $picpath = $request->file('pic')->storeAs(
                'public/avatar', $picname
            );
            
            //저장하는 경로와 웹에서 접근가능한 경로가 달라서 저장위치와 db에 저장될 파일경로는 다르게 해줌
            $pic = 'storage/avatar/'.$picname;
            //dd($picpath);

            $user = User2::find($request->input('id'));
            //경로다보니 암호화가 필요
            $user->profile_photo_path = Crypt::encryptString($pic);

            $user->save();

            return redirect()->route('userinfo.show')->with('success', '회원 정보가 수정되었습니다.');
        }
        elseif(!$request->hasfile('pic')){
            return redirect()->back()->with('error', '사진을 선택해주세요.');
        }
       
    }
    //사진 제거(그냥 DB에 null) 매개변수로 id를 받아와도 되지만 Auth활용
    public function picDelete(){

        $user = User2::find(Auth::user()->id);

        File::delete(Crypt::decryptString($user->profile_photo_path));

        $user->profile_photo_path = null;

        $user->save();

        return redirect()->route('userinfo.show')->with('success', '사진이 제거되었습니다.');
    }
    public function update(Request $request, $id)
    { 
        //유효성 검사
        $validatedData = $request->validate([
            'username' => 'required|max:100',
            'email' => 'required|email',
        ]);
        //정보 수정
        $user = User2::find($id);
        $user->name = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->save();
        return redirect()->route('userinfo.show')->with('success', '회원 정보가 수정되었습니다.');
    }
    
    public function delete(Request $request, $id){
        if(Auth::user()->profile_photo_path){
            //사진이 있는경우 db에 저장된 사진 경로 복호화해서 삭제
            File::delete(Crypt::decryptString(Auth::user()->profile_photo_path));
        }
        $user = User2::find($id);
        $user->delete();
        //status변수를 통해 회원 탈퇴라고 알림
        return view('users.congratulations', [
            'path' => 'congratulations',
            'status' => 'delete',
        ]);
    }
}