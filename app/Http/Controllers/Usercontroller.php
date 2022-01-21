<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User2;
use App\Mail\UpdatePassword;

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

    public function forgotPasswordNotice(){

        return view('users.forgot-password-notice',[
            'path' => 'forgot_password_notice'
        ]);
    }

    public function forgotPasswordValidate(Request $request){
        //유효성 검사
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);
        //가입된 이메일이 아닌경우
        if(!User2::where('email', $request->input('email'))->first()){

            return redirect()->back()->with('status', '가입되지 않은 이메일 입니다.');
        }
        //가입된 이메일이지만 인증이 되지않은경우
        elseif(User2::where('email', $request->input('email'))->where('email_verified_at',  null)->first()){

            return redirect()->back()->with('status', '이메일 인증이 안된 이메일 입니다 인증을 먼저 진행해주세요.');
        }
        //가입된 이메일이고 인증로 이루어진 이메일인 경우
        elseif($user = User2::where('email', $request->input('email'))->where('email_verified_at', '!=',  null)->first()){

            //토큰자체 생성 
            $token = Str::random(60);
            //토큰과 이메일을 password_resets테이블에 저장(만료시킬때 활용)
            DB::table('password_resets')->insert([
                'email' => $request->input('email'),
                'token' => $token,
                'created_at' => now()
            ]);

            Mail::to($user->email)->send(new UpdatePassword($user->name, $token));

            return redirect()->back()->with('success', '입력하신 이메일로 비밀번호 변경 링크를 전송했습니다 확인해주세요.');
        }
    }

    public function changePassword(){
        return view('users.update-password',[
            'path' => 'update_password'
        ]);
    }

    public function updatePassword(Request $request){
        //현재 비밀번호가 입력된다면(내정보에서 온 경우)
        if($request->input('current_password')){
            if(!Hash::check($request->input('current_password'), Auth::user()->password)){
                return redirect()->back()->with('error', '현재 비밀번호가 일치하지않습니다');
            }
        }
        //유효성 검사
        $validatedData = $request->validate([
            'password' => 'required|max:255|min:8',
            'password_confirm' => 'required|same:password|min:8',
        ]);

        //정보 수정
        //로그인된 경우
        if($request->input('current_password')){
            $user = User2::find(Auth::user()->id);
            $user->password = Hash::make($validatedData['password']);
            $user->save();
            Auth::logout();
            return redirect()->route('main')->with('success', '비밀번호가 변경되었습니다.');
        }
        else{
            //비로그인인 경우
            //url부분에서 토큰부분만 자르고 DB에 조회해서 정보 update
            $url = explode('/',$request->input('url')); 
            $token = end($url);

            $email = DB::table('password_resets')->select('email')->where('token', $token)->get();

            $user = User2::where('email', $email[0]->email)->first();
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            return redirect()->route('main')->with('success', '비밀번호가 변경되었습니다.');
        }
        
    }
}