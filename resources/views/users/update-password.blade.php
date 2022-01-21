@extends('layouts.user')

@section('update_password_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('update_password_content')

        <form class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md" method="POST" action="{{ route('update-password') }}">
            @csrf
            <input type="hidden" name="url" id="url" value="{{ url()->current() }}">
            <p class="mb-5 text-3xl uppercase text-gray-600">비밀번호 변경</p>
            {{-- 로그인해서 내정보에서 비번변경 선택시 현재 비밀번호 입력창 활성화 --}}
            @if (Auth::check())
                <input type="password" name="current_password" class="mt-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none " autocomplete="off" placeholder="현재 비밀번호">
                @if(Session::has('error'))
                    <div class=" mr-16 alert alert-danger text-red-600">{{ session()->get('error') }}</div>
                @endif
            @endif
            <input type="password" name="password" class="@error('password') is-invalid @enderror mt-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none " autocomplete="off" placeholder="새로운 비밀번호">
            @error('password')
                <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirm" class="@error('password_confirm') is-invalid @enderror mt-5 p-3 w-80 focus:border-purple-700 rounded border-2 outline-none " autocomplete="off" placeholder="비밀번호 확인">
            @error('password_confirm')
                <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror

            <button class="bg-purple-600 hover:bg-purple-900 text-white font-bold p-2 rounded w-80 m-2" id="login" type="submit"><span>로그인</span></button>
        </form>

@endsection