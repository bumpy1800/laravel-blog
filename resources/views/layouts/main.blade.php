<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('header.main_header')
    </head>
    <body>
        {{-- 상단 네비바 : start --}}
        <nav class="flex items-center justify-between bg-gray-800 h-20 shadow-2xl">
            @include('nav.main_nav')
        </nav>
        {{-- 상단 네비바 : end --}}

        {{-- 중앙 게시글 리스트 : start --}}
        @sectionMissing('main_content')
            @yield('post_detail_content')
        @else
            @yield('main_content')
        @endif

        {{-- 중앙 게시글 리스트 : end --}}

        {{-- 하단 푸터 : start --}}
        @include('footer.main_footer')
        {{-- 하단 푸터 : end --}}
    </body>
</html>
