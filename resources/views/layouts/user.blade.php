<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- head테그안에 css나 js등 각 회원관련페이지 마다 다르게 적용 --}}
        @switch($path)
            @case('login')
                @yield('login_header')        
                @break
            @case('register')
                @yield('register_header')
                @break
            @case('congratulations')
                @yield('congratulations_header')        
                @break
            @case('info')
                @yield('userinfo_header')        
                @break
            @case('forgot_password_notice')
                @yield('forgot_password_notice_header')        
                @break
            @case('update_password')
                @yield('update_password_header')        
                @break
            @default
                
        @endswitch
        
    </head>
    <body>
        {{-- 중앙 화면 : start --}}
        <div class="w-screen h-screen flex justify-center items-center bg-gray-100 flex-col">
            @switch($path)
                @case('login')
                    @yield('login_content')
                    @break
                @case('register')
                    @yield('register_content')
                    @break  
                @case('congratulations')
                    @yield('congratulations_content')        
                    @break
                @case('info')
                    @yield('userinfo_content')        
                    @break
                @case('forgot_password_notice')
                    @yield('forgot_password_notice_content')        
                    @break  
                @case('update_password')
                    @yield('update_password_content')        
                    @break        
                @default
            @endswitch
        </div>
        {{-- 중앙 화면 : end --}}
        @if ('path' == 'login')
            @yield('login_script') 
        @endif

    </body>
</html>
