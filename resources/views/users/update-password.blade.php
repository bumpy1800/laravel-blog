@extends('layouts.user')

@section('update_password_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('update_password_content')
        @if(Session::has('error'))
        <script type="text/javascript">

            alert("{{ session()->get('error') }}");

        </script>
        @endif
        <form class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md" method="POST" action="{{ route('login') }}">
            @csrf
            <p class="mb-5 text-3xl uppercase text-gray-600">비밀번호 변경</p>
            <input type="password" name="password" class="@error('password') is-invalid @enderror mt-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none " autocomplete="off" placeholder="Password">
            @error('password')
                <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirm" class="@error('password_confirm') is-invalid @enderror mt-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none " autocomplete="off" placeholder="Password_confirm">
            @error('password_confirm')
                <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror

            <button class="bg-purple-600 hover:bg-purple-900 text-white font-bold p-2 rounded w-80 m-2" id="login" type="submit"><span>로그인</span></button>
        </form>

@endsection