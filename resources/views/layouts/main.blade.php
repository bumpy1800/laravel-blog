<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @hasSection('post_create_header')
            @yield('post_create_header')
        @else
            @include('header.main_header')
        @endif
    </head>
    <body>
        {{-- 상단 네비바 : start --}}
        <nav class="flex items-center justify-between bg-gray-800 h-20 shadow-2xl">
            @include('nav.main_nav')
        </nav>
        {{-- 상단 네비바 : end --}}

        {{-- 중앙 컨텐츠 : start --}}
        @hasSection('main_content')
            @yield('main_content')
        @endif

        @hasSection('post_detail_content')
            @yield('post_detail_content')
        @endif

        @hasSection('post_create_content')
            @yield('post_create_content')
        @endif
        {{-- 중앙 컨텐츠 : end --}}

        {{-- 하단 푸터 : start --}}
        @include('footer.main_footer')
        {{-- 하단 푸터 : end --}}
    </body>
</html>
