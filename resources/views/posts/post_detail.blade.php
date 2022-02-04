@extends('layouts.main')

@section('post_detail_content')
<section class="font-mono bg-white container mx-auto px-5">
    <div class="flex flex-col items-center py-8">
      <div class="flex flex-col w-9/12 mb-10 text-left">
        <span class="font-light text-gray-600">{{ $posts->created_at->format('Y/m/d H:i') }}</span>
        <div class="w-full mx-auto lg:w-1/2">
          <h1 class="mx-auto mb-6 text-2xl font-semibold text-black lg:text-3xl">{{ $posts->title }}</h1>
          <p class="mx-auto text-base font-medium leading-relaxed text-gray-800">{!! $posts->content !!}</p>
        </div>
  
        <div class="p-4 mt-4 bg-white border rounded-lg w-6/12 lg:w-1/2">
          <div class="flex py-2 mb-4 w-full">
            <img src="https://images.unsplash.com/photo-1530268729831-4b0b9e170218?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" class="object-cover w-12 h-12 mr-2 rounded-full" />
            <div>
              <p class="font-bold text-lg tracking-tight text-black">{{ $posts->writer }}</p>
            </div>
          </div>
        </div>
      </div>
      @if (Auth::check() && $posts->writer == Auth::user()->name)
      <form action="{{ route('posts.destroy',['post' => $posts]) }}" method="post" class="w-9/12" id="del">
        @csrf
        @method('DELETE')
          <a href="{{ route('posts.edit',['post' => $posts]) }}" 
            class="-mt-2 mr-3 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">수정하기</a>
          <a onclick="del();" href='#'
            class="-mt-2 mr-3 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">삭제하기</a>
      </form>
      @endif
    </div>
  </section>
  <script>
    //confirm창으로 게시글 삭제여부 파악
    function del(){
      var con_test = confirm('정말 삭제하시겠습니까?');
      if(con_test == true){
        document.getElementById('del').submit();
      }
      else if(con_test == false){
        return;
      }
    }
  </script>
@endsection