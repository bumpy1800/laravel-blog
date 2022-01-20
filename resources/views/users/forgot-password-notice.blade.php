@extends('layouts.user')

@section('forgot_password_notice_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('forgot_password_notice_content')

<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <div class="mb-4 text-sm text-gray-600">
        비밀번호를 잊어 버렸습니까? 문제 없어요. 이메일 주소를 알려주시면 새 비밀번호를 선택할 수 있는 비밀번호 재설정 링크를 이메일로 보내드리겠습니다.
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ session('status') }}
        </div>
    @elseif(session('success'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('success') }}
        </div>
    @endif

    @error('email')
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="{{ route('forgot-password') }}">
        @csrf
        <div class="block">
            <label class="block font-medium text-sm text-gray-700" for="email">
                Email
            </label>
            <input class="@error('email') is-invalid @enderror border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
            id="email" type="email" name="email" required autofocus>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                비밀번호 링크 보내기
            </button>
        </div>
    </form>
</div>

@endsection