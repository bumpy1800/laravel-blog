<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @yield('main_header')
    </head>
    <body>
        {{-- 상단 네비바 : start --}}
        <nav class="flex items-center justify-between bg-gray-800 h-20 shadow-2xl">
            @yield('main_content')
        </nav>
        {{-- 상단 네비바 : end --}}
    </body>
</html>
