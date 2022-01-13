@extends('layouts.user')

@section('congratulations_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('congratulations_content')
@if ($status == 'delete')
    <div class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md">
        <p class="mb-5 text-3xl uppercase text-gray-600">회원 탈퇴 완료</p>
        <p>회원 정보가 모두 삭제되었고 계정탈퇴가 완료되었습니다</p>
        <button class="bg-indigo-600 hover:bg-indigo-900 text-white font-bold p-2 rounded w-80 m-2" id="register" type="button" onclick="location.href='{{ route('main') }}'"><span>홈으로</span></button>
    </div>
@elseif ($status == 'register')
    <div class="p-10 bg-white rounded flex justify-center items-center flex-col shadow-md">
        <p class="mb-5 text-3xl uppercase text-gray-600">축하드립니다!!</p>
        <p>회원가입이 완료되었고 앞으로 회원으로 활동하실 수 있습니다</p>
        <button class="bg-indigo-600 hover:bg-indigo-900 text-white font-bold p-2 rounded w-80 m-2" id="register" type="button" onclick="location.href='{{ route('main') }}'"><span>홈으로</span></button>
    </div>
@endif
@endsection