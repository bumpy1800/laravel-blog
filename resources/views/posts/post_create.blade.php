@extends('layouts.main')

@section('post_create_header')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"  />
    {{-- tailwind dropdown 이나 modal같은 기능작용 --}}
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />

    <script src="{{ asset("ckeditor/ckeditor.js") }}"></script>
    
    <title>{{ env('APP_NAME') }}</title>
@endsection

@section('post_create_content')
<form class="bg-white" method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="min-h-screen md:px-20 pt-6">
      <div class=" bg-white rounded-md px-6 py-10 max-w-2xl mx-auto">
        <h1 class="text-center text-2xl font-bold text-gray-500 mb-10">글 작성</h1>
        <div class="space-y-4">
          <div>
            <label for="title" class="text-lx font-serif">제목:</label>
            <input type="text" placeholder="제목" name="title" id="title" class="@error('title') is-invalid @enderror w-4/5 ml-2 outline-none py-1 px-2 text-md border-2 rounded-md" />
            @error('title')
              <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror
          </div>
          <div>
            <label for="editor" class="block mb-2 text-lg font-serif">내용:</label>
            <textarea class="@error('editor') is-invalid @enderror form-control" id="editor" name="editor"></textarea>
            @error('editor')
              <div class=" mr-16 alert alert-danger text-red-600">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="px-6 py-2 mx-auto block rounded-md text-lg font-semibold text-indigo-100 bg-indigo-600  ">작성 완료</button>
        </div>
      </div>
    </div>
  </form>
  <script>
        CKEDITOR.replace('editor', {
          filebrowserUploadUrl: "{{ route('posts.upload', ['_token' => csrf_token()]) }}",
          filebrowserUploadMethod: 'form',
        });
    </script>
@endsection