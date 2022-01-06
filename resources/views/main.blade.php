@extends('layouts.main')

@section('main_header')
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

  <title>{{ env('APP_NAME') }}</title>
@endsection

@section('main_content')

    <div class="logo">
      <h1 class="text-white ml-4 cursor-pointer text-2xl">Laravel-Blog</h1>
    </div>
    <ul class="flex">
    @Auth
       <li>
        <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="#" style="
    ">글쓰기</a>
    @endauth
    @if (Auth::check())
      <li>
        <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="{{ route('logout') }}" style="
      ">로그아웃</a>
      </li>
    @else
      <li>
        <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="{{ route('login.index') }}" style="
      ">로그인</a>
      </li>
    @endif

    </ul>

@endsection