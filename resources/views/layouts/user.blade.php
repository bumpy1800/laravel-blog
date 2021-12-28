<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @yield('user_header')
    </head>
    <body>
        {{-- 중앙 화면 : start --}}
        <div class="w-screen h-screen flex justify-center items-center bg-gray-100">
            @yield('login_content')
        </div>
        {{-- 중앙 화면 : end --}}
        @yield('login_script')
    </body>
</html>
