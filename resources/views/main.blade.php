<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

      <title>{{ env('APP_NAME') }}</title>

    </head>
    <body>
      <nav class="flex items-center justify-between bg-gray-800 h-20 shadow-2xl">
        <div class="logo">
          <h1 class="text-white ml-4 cursor-pointer text-2xl">Laravel-Blog</h1>
        </div>
        <ul class="flex">
          {{-- <li>
            <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="#" style="
            padding-left: 15px;
            padding-right: 15px;
            margin-left: 15px;
            margin-right: 15px;
        "><i class="fas fa-home"></i> Login</a> --}}
          <li>
            <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="#" style="
            padding-left: 15px;
            padding-right: 15px;
            margin-left: 15px;
            margin-right: 15px;
        ">Login</a>
          </li>
        </ul>
      </nav>
    </body>
</html>
