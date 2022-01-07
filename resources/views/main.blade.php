@extends('layouts.main')

@section('main_header')
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />
  <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
  {{-- tailwind dropdown 이나 modal같은 기능작용 --}}
  <title>{{ env('APP_NAME') }}</title>
@endsection

@section('main_content')
    @if(Session::has('success'))
    <script type="text/javascript">

        alert("{{ session()->get('success') }}");

    </script>
    @endif

    <div class="logo">
      <h1 class="text-white ml-4 cursor-pointer text-2xl">Laravel-Blog</h1>
    </div>
    <ul class="flex items-center">
    @if (Auth::check())
    <li>
      <button id="dropdownButton" data-dropdown-toggle="dropdown" class="text-white mr-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown button <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>
    </li>
    <!-- Dropdown menu -->
    <div id="dropdown" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
        <ul class="py-1" aria-labelledby="dropdownButton">
          <li>
            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">내정보</a>
          </li>
          <li>
            <a href="{{ route('logout') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" >로그아웃</a>
          </li>
        </ul>
    </div>
    <li>
      <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="#" style="
  ">글쓰기</a>
    </li>
    @else
    <li>
      <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="{{ route('login.index') }}" style="
    ">로그인</a>
    </li>
  @endif
    </ul>
      {{-- tailwind dropdown 이나 modal같은 기능작용 --}}
    <script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>

@endsection