@extends('layouts.user')

@section('userinfo_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('userinfo_content')
    <!-- 사진 유효성검사 에러메시지 alert창으로 표현 -->
    @error('pic')
        <script type="text/javascript">

            alert("{{ $message }}");

        </script>
    @enderror
    {{-- alert.blade.php 불러와서 성공실패 메시지 출력 --}}
    @include('layouts.alert')
    <div class="border-b-2 block md:flex w-3/5">
      <div class="text-center w-2/6 md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
        <div class="flex justify-between">
          <span class="text-xl font-semibold block">회원 정보</span>
        </div>
        <form action="{{ route('userinfo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full p-8 mx-2 flex justify-center">
          {{-- 회원DB에 사진이없으면 기본이미지 있으면 사진경로를 복호화해서 출력 --}}
        @if (Auth::user()->profile_photo_path) 
            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ Crypt::decryptString(Auth::user()->profile_photo_path) }}" alt="">
        @else
            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ asset('storage/default_profile.jpg'); }}" alt="">
        @endif
                                  
        </div>
        {{-- 그냥 컨트롤러에서 Auth::user()->id 해도 되지만 restful하게 설계하기위해 매개변수로 넘김 --}}
        <input type="hidden" id="id" name="id" value="{{ Auth::user()->id }}">
        <input type="file" id="pic" name="pic" class=" @error('pic') is-invalid @enderror-mt-2 mb-5 text-md font-bold text-white bg-gray-700 rounded-full hover:bg-gray-800">
          <button type="submit" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">사진 수정</button>
        @if (Auth::user()->profile_photo_path)
          <a type="button" href="{{ route('userinfo.picDelete') }}" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">X</a>
        @endif
        </form>
        
      </div>
        <div class="w-4/6 md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
          {{-- @method('PATCH')를 해야 PATCH메소드가 지원됨 원래는 지원안함 --}}
          <form action="{{ route('userinfo.update',['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="" id="" value="" />{{-- enter로 인한 submit 막기 --}}
            <div class="rounded shadow p-6 mb-3">
              <div class="pb-6">
                <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
                <div class="flex flex-col">
                  <input disabled id="username" name="username" class="@error('username') is-invalid @enderror border-1  rounded-r px-4 py-2 w-full" type="text" value="{{ Auth::user()->name }}" />
                @error('username')
                  <div class="alert alert-danger text-red-600">{{ $message }}</div>
                @enderror
                </div>
              </div>
              <div class="pb-4">
                <label for="about" class="font-semibold text-gray-700 flex pb-1">Email
                  @if (Auth::user()->email_verified_at)
                    <div class="bg-green-400 ml-2 px-2">
                      <i class="far fa-circle"></i>
                    인증 완료
                    </div>
                  @else
                    <div class="bg-rose-400 ml-2 px-2">
                      <i class="fa fa-times"></i>
                    인증되지않음
                    </div>
                  @endif
                </label>
                <input disabled id="email" name="email" class="@error('email') is-invalid @enderror border-1  rounded-r px-4 py-2 w-full" type="email" value="{{ Auth::user()->email }}" />
                @error('email')
                  <div class="alert alert-danger text-red-600">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="float-right">
              @if (!Auth::user()->email_verified_at)
                <a href="{{ URL::route('verification.notice') }}" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">이메일 인증</a>
              @endif
              
              <button type="button" id="modify" onclick="edit();" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">정보 수정</button>
            </div>
          </form>
          </div>
    </div>
    <div class="w-3/5 flex justify-end">
      <form action="{{ route('userinfo.delete',['id' => Auth::user()->id]) }}" method="post" id="del">
        @csrf
        @method('DELETE')
        <a href="#" class="underline" onclick="del();">회원 탈퇴</a>
      </form>
    </div>
<script type="text/javascript">
  //수정버튼을 누르면 input태그의 disable이 해제되고 버튼이 수정완료로 바뀌며 onclick대상함수가 변경
  function edit(){
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var modify = document.getElementById('modify');

    username.disabled=false;
    email.disabled=false;
    username.focus();
    modify.innerText = '수정완료';
    modify.className = "-mt-2 text-md font-bold text-white bg-indigo-700 rounded-full px-5 py-2 hover:bg-indigo-900";
    modify.setAttribute('onclick','update();');
  };
  //submit시기는 함수
  function update(){
    var modify = document.getElementById('modify');
    modify.setAttribute('type','submit');
  }
  //confirm창으로 탈퇴여부 파악
  function del(){
    var con_test = confirm("정말 탈퇴하시겠습니까?");
    if(con_test == true){
      //location.href="{{ route('userinfo.delete',['id' => Auth::user()->id]) }}"
      document.getElementById('del').submit();
    }
    else if(con_test == false){
        return;
    } 
  }
</script>
@endsection