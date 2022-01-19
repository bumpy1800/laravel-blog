@extends('layouts.user')

@section('login_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('login_content')
        @if(Session::has('error'))
        <script type="text/javascript">

            alert("{{ session()->get('error') }}");

        </script>
        @endif
        <form class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md" method="POST" action="{{ route('login') }}">
            @csrf
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-600 mb-2" viewbox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
            </svg>
            <p class="mb-5 text-3xl uppercase text-gray-600">Login</p>
            <input type="email" name="email" class="@error('email') is-invalid @enderror mt-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none " autocomplete="off" placeholder="Email">  
            @error('email')
                <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror
            <input type="password" name="password" class="@error('password') is-invalid @enderror mt-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none " autocomplete="off" placeholder="Password">
            @error('password')
                <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror
            <div class="flex justify-start w-80">
                <label class="block text-gray-500 font-bold my-4 flex items-center">
                    <input class="leading-loose text-pink-600 top-0" type="checkbox" id="remember" name="remember"/>
                    <span class="ml-2 text-sm py-2 text-gray-600 text-left">
                        회원정보 기억하기
                    </span>
                </label>
            </div>
            <label class="block text-gray-500 font-bold my-4 flex items-center"> 
                <a href="#" class="ml-2 text-sm py-2 text-gray-600 text-left underline">비밀번호를 잊어버리셨나요?</a>
            </label>
            <button class="bg-purple-600 hover:bg-purple-900 text-white font-bold p-2 rounded w-80 m-2" id="login" type="submit"><span>로그인</span></button>
            <button class="bg-indigo-600 hover:bg-indigo-900 text-white font-bold p-2 rounded w-80 m-2" id="register" type="button" onclick="location.href='{{ route('register.create') }}'"><span>회원가입</span></button>
        </form>

@endsection

@section('login_script')

    <script>
        // document.getElementById("login").addEventListener("click", function(event){
        // event.preventDefault();
        // });
    </script>
@endsection