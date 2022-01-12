@extends('layouts.user')

@section('userinfo_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('userinfo_content')
    <!-- This is an example component -->
    @error('pic')
        <script type="text/javascript">

            alert("{{ $message }}");

        </script>
    @enderror
    @include('layouts.alert')
    {{-- @dump() --}}
    <div class="border-b-2 block md:flex w-3/5">
      <div class="text-center w-2/6 md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
        <div class="flex justify-between">
          <span class="text-xl font-semibold block">회원 정보</span>
        </div>
        <form action="{{ route('userinfo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full p-8 mx-2 flex justify-center">
        @if (Auth::user()->profile_photo_path)
            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ Crypt::decryptString(Auth::user()->profile_photo_path) }}" alt="">
        @else
            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ asset('storage/default_profile.jpg'); }}" alt="">
        @endif
                                  
        </div>
        <input type="hidden" id="id" name="id" value="{{ Auth::user()->id }}">
        <input type="file" id="pic" name="pic" class=" @error('pic') is-invalid @enderror-mt-2 mb-5 text-md font-bold text-white bg-gray-700 rounded-full hover:bg-gray-800">
          <button type="submit" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">사진 수정</button>
        @if (Auth::user()->profile_photo_path)
          <a type="button" href="{{ route('userinfo.picDelete') }}" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">X</a>
        @endif
        </form>
        
      </div>

        <div class="w-4/6 md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
          <div class="rounded shadow p-6 mb-3">
            <div class="pb-6">
              <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
              <div class="flex">
                <input disabled id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text" value="{{ Auth::user()->name }}" />
              </div>
            </div>
            <div class="pb-4">
              <label for="about" class="font-semibold text-gray-700 flex pb-1">Email
                <div class="bg-rose-400 ml-2 px-2">
                  <i class="fa fa-times"></i>
                인증되지않음
                </div>
              </label>
              <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" value="{{ Auth::user()->email }}" />
            </div>
          </div>
          <div class="float-right">
            <a href="#" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">이메일 인증</a>
            <button type="button" id="modify" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">정보 수정</button>
          </div>
        </div>
    </div>
<script type="text/javascript">
  document.getElementById("modify").addEventListener("click",update);

  function update(){
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var modify = document.getElementById('modify');

    username.disabled=false;
    email.disabled=false;
    username.focus();
    modify.innerText='수정완료';
    modify.className="-mt-2 text-md font-bold text-white bg-indigo-700 rounded-full px-5 py-2 hover:bg-indigo-900";
    modify.setAttribute('type','submit')
  };
</script>
@endsection