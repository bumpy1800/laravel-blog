@extends('layouts.user')

@section('register_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
@endsection

@section('register_content')
<div class="p-8 bg-white rounded flex justify-center items-center flex-col shadow-md">
    <div class="container max-w-full mx-auto px-6">
        <div class="max-w-sm mx-auto px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="md:mt-6">
                        <div class="text-center font-semibold text-black">
                            회원가입
                        </div>
                        <div class="text-center font-base text-black">
                            가입할 정보를 입력해주십시오
                        </div>
                            <form class="mt-8" x-data="{password: '',password_confirm: ''}" method="POST" action="{{ route('register.store') }}">
                                @csrf
                                <div class="mx-auto max-w-lg ">
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">닉네임</span>
                                        <input placeholder="" type="text" id="name" name="name"
                                            class="@error('name') is-invalid @enderror text-md block px-3 py-2 rounded-lg w-full
                        bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    @error('name')
                                        <div class="alert alert-danger text-red-600">{{ $message }}</div>
                                    @enderror
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">이메일</span>
                                        <input placeholder="" type="email" id="email" name="email"
                                            class=" @error('name') is-invalid @enderror text-md block px-3 py-2 rounded-lg w-full
                        bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    @error('email')
                                        <div class="alert alert-danger text-red-600">{{ $message }}</div>
                                    @enderror
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">비밀번호</span>
                                            <input placeholder="" type="password" x-model="password"
                                                id="password" name="password"
                                                class="@error('name') is-invalid @enderror text-md block px-3 py-2 rounded-lg w-full
                            bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                        </div>
                                        @error('password')
                                            <div class="alert alert-danger text-red-600">{{ $message }}</div>
                                        @enderror
                                        <div class="py-1">
                                            <span class="px-1 text-sm text-gray-600">비밀번호 확인</span>
                                            <input placeholder="" type="password" x-model="password_confirm"
                                                id="password_confirm" name="password_confirm"
                                                class="@error('name') is-invalid @enderror text-md block px-3 py-2 rounded-lg w-full
                            bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                        </div>
                                        @error('password_confirm')
                                            <div class="alert alert-danger text-red-600">{{ $message }}</div>
                                        @enderror
                                        <div class="flex justify-start mt-3 ml-4 p-1">
                                            <ul>
                                                <li class="flex items-center py-1">
                                                    <div :class="{'bg-green-200 text-green-700': password == password_confirm && password.length > 0, 'bg-red-200 text-red-700':password != password_confirm || password.length == 0}"
                                                        class=" rounded-full p-1 fill-current ">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path x-show="password == password_confirm && password.length > 0" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 13l4 4L19 7"/>
                                                            <path x-show="password != password_confirm || password.length == 0" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12"/>

                                                        </svg>
                                                    </div>
                                                    <span :class="{'text-green-700': password == password_confirm && password.length > 0, 'text-red-700':password != password_confirm || password.length == 0}"
                                                        class="font-medium text-sm ml-3"
                                                        x-text="password == password_confirm && password.length > 0 ? '비밀번호가 일치합니다' : '비밀번호가 일치하지 않습니다' "></span>
                                                </li>
                                                <li class="flex items-center py-1">
                                                    <div :class="{'bg-green-200 text-green-700': password.length > 7, 'bg-red-200 text-red-700':password.length < 7 }"
                                                        class=" rounded-full p-1 fill-current ">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path x-show="password.length > 7" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M5 13l4 4L19 7"/>
                                                            <path x-show="password.length < 7" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12"/>

                                                        </svg>
                                                    </div>
                                                    <span :class="{'text-green-700': password.length > 7, 'text-red-700':password.length < 7 }"
                                                        class="font-medium text-sm ml-3"
                                                        x-text="password.length > 7 ? '최소 길이를 충족했습니다' : '최소 8자 이상 필요' "></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="flex justify-start">
                                            <label class="block text-gray-500 font-bold my-4 flex items-center">
                                                <input class=" @error('poliy') is-invalid @enderror leading-loose text-pink-600 top-0" type="checkbox" id="poliy" name="poliy"/>
                                                <span class="ml-2 text-sm py-2 text-gray-600 text-left">사이트의
                                                    <a href="#"
                                                        class="font-semibold text-black border-b-2 border-gray-200 hover:border-gray-500">
                                                    이용약관
                                                    </a>및
                                                    <a href="#"
                                                        class="font-semibold text-black border-b-2 border-gray-200 hover:border-gray-500">
                                                        정보데이터 정책</a>
                                                        에 동의 합니다
                                                </span>
                                            </label>
                                        </div>
                                        @error('poliy')
                                            <div class="alert alert-danger text-red-600">{{ $message }}</div>
                                        @enderror
                                        <button class="mt-3 text-lg font-semibold
                        bg-gray-800 w-full text-white rounded-lg
                        px-6 py-3 block shadow-xl hover:text-white hover:bg-black" type="submit">
                                            회원가입
                                        </button>
                                    </div>
                                </form>

                                <div class="text-sm font-semibold block sm:hidden py-6 flex justify-center">
                                    <a href="#"
                                    class="text-black font-normal border-b-2 border-gray-200 hover:border-teal-500">You're already member?
                                        <span class="text-black font-semibold">
                                        Login
                                        </span>
                                    </a>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection