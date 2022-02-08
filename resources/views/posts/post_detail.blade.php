@extends('layouts.main')

@section('post_detail_content')
<section class="font-mono bg-white container mx-auto px-5">
    <div class="flex flex-col items-center py-8">
        {{-- 게시물 : 시작 --}}
      <div class="flex flex-col w-9/12 mb-10 text-left">
        <span class="font-light text-gray-600">{{ $posts->created_at->format('Y/m/d H:i') }}</span>
        <div class="w-full mx-auto lg:w-1/2">
          <h1 class="mx-auto mb-6 text-2xl font-semibold text-black lg:text-3xl">{{ $posts->title }}</h1>
          <p class="mx-auto text-base font-medium leading-relaxed text-gray-800">{!! $posts->content !!}</p>
        </div>
  
        <div class="p-4 mt-4 bg-white border rounded-lg w-6/12 lg:w-1/2">
          <div class="flex py-2 mb-4 w-full">
            <img src="{{ asset('storage\default_profile.jpg') }}" class="object-cover w-12 h-12 mr-2 rounded-full" />
            <div>
              <p class="font-bold text-lg tracking-tight text-black">{{ $posts->writer }}</p>
            </div>
          </div>
        </div>
      </div>
      @if (Auth::check() && $posts->writer == Auth::user()->name)
      <form action="{{ route('posts.destroy',['post' => $posts]) }}" method="post" class="w-9/12 mb-8" id="del">
        @csrf
        @method('DELETE')
          <a href="{{ route('posts.edit',['post' => $posts]) }}" 
            class="-mt-2 mr-3 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">수정하기</a>
          <a onclick="del();" href='#'
            class="-mt-2 mr-3 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">삭제하기</a>
      </form>
      @endif
      {{-- 게시물 : 끝 --}}
      {{-- 댓글작성 : 시작 --}}
      <div class="flex flex-col w-9/12 mb-10 text-left">
        <form action="{{ route('comment.store') }}" method="post" class="w-full max-w-xl bg-white rounded-lg px-4 pt-2">
          @csrf
          <input type="hidden" name="post_id" value="{{ $posts->id }}">
          <div class="flex flex-wrap -mx-3 mb-6">
              <h1 class="mb-6 text-xl font-semibold text-black">새 댓글 달기</h2>
              <div class="w-full md:w-full mb-2 mt-2">
                <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="content" placeholder='내용을 입력해주세요.' required></textarea>
              </div>
              <div class="w-full md:w-full flex items-start md:w-full px-3">
                <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">
                </div>
                <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">
                </div>
                <div class="-mr-1">
                    <input type='submit' class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" value='댓글 작성하기'>
                </div>
              </div>
          </form>
        </div>
        {{-- 댓글작성 : 끝 --}}
        {{-- 댓글리스트 : 시작 --}}
        <div class="antialiased max-w-screen-sm">
          <h3 class="mb-4 text-lg font-semibold text-gray-900">댓글 {{ $comments->count() }}개</h3> 
          @foreach ($comments as $comment)
            <div class="space-y-4 mb-3"> 
              <div class="flex">
                <div class="flex-shrink-0 mr-3">
                  <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" src="{{ asset('storage\default_profile.jpg') }}" alt="">
                </div>
                <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                  <strong>{{ $comment->writer }}</strong> <span class="text-xs text-gray-400">{{ $comment->created_at->format('Y/m/d H:i') }}</span>
                  <p class="text-sm">
                    {{ $comment->content }}
                  </p>
                  <div class="mt-4 flex items-center">
                    <div class="text-sm text-gray-500 font-semibold">
                      <p class="hover:underline text-blue-500">
                        <a href="#"><i class="fas fa-chevron-right"></i> 5개의 댓글(ajax로 구현할 예정 현재는 테스트)</a>
                      </p>
                      <div class="space-y-2">
                        <div class="flex">
                          <div class="flex-shrink-0 mr-3">
                            <img class="mt-3 rounded-full w-6 h-6 sm:w-8 sm:h-8" src="{{ asset('storage\default_profile.jpg') }}" alt="">
                          </div>
                          <div class="flex-1 bg-gray-100 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed mt-4">
                            <strong>작성자</strong> <span class="text-xs text-gray-400">작성 시간</span>
                            <p class="text-sm sm:text-sm">
                            대댓글 내용
                            </p>
                          </div>
                        </div>
                        <div class="flex">
                          <div class="flex-shrink-0 mr-3">
                            <img class="mt-3 rounded-full w-6 h-6 sm:w-8 sm:h-8" src="{{ asset('storage\default_profile.jpg') }}" alt="">
                          </div>
                          <div class="flex-1 bg-gray-100 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed mt-4">
                            <strong>작성자</strong> <span class="text-xs text-gray-400">작성 시간</span>
                            <p class="text-xs sm:text-sm">
                            대댓글 내용
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          @endforeach
          {{-- 댓글리스트 : 끝 --}}
        </div>
      </div>
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