@extends('layouts.user')

@section('userinfo_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />

    <title>{{ env('APP_NAME') }}</title>

@endsection

@section('userinfo_content')
    <!-- This is an example component -->
    @error('pic')
        <script type="text/javascript">

            alert("{{ $message }}");

        </script>
    @enderror
    <div class="border-b-2 block md:flex w-3/5">
      @include('layouts.alert')
      <div class="text-center w-2/6 md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
        <div class="flex justify-between">
          <span class="text-xl font-semibold block">회원 정보</span>
        </div>
        <form action="{{ route('userinfo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full p-8 mx-2 flex justify-center">
        @if (Auth::user()->profile_photo_url)
            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ Auth::user()->profile_photo_url }}" alt="">
        @else
            <img id="showImage" class="max-w-xs w-32 items-center border" src="{{ asset('storage/default_profile.jpg'); }}" alt="">
        @endif
                                  
        </div>
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        <input type="file" id="pic" name="pic" class=" @error('pic') is-invalid @enderror-mt-2 mb-5 text-md font-bold text-white bg-gray-700 rounded-full hover:bg-gray-800">
          <button type="submit" class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">사진 수정</button>
        </form>
      </div>
      
      <div class="w-4/6 md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
        <div class="rounded  shadow p-6">
          <div class="pb-6">
            <label for="name" class="font-semibold text-gray-700 block pb-1">Name</label>
            <div class="flex">
              <input disabled id="username" class="border-1  rounded-r px-4 py-2 w-full" type="text" value="{{ Auth::user()->name }}" />
            </div>
          </div>
          <div class="pb-4">
            <label for="about" class="font-semibold text-gray-700 block pb-1">Email</label>
            <input disabled id="email" class="border-1  rounded-r px-4 py-2 w-full" type="email" value="{{ Auth::user()->email }}" />
          </div>
        </div>
      </div>
  
    </div>
@endsection