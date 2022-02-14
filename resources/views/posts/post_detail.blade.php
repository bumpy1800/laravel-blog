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
      <form action="{{ route('posts.destroy',['post' => $posts]) }}" method="post" class="w-9/12 mb-8" id="post_del">
        @csrf
        @method('DELETE')
          <a href="{{ route('posts.edit',['post' => $posts]) }}" 
            class="-mt-2 mr-3 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">수정하기</a>
          <a onclick="del('post_del');" href='#'
            class="-mt-2 mr-3 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800">삭제하기</a>
      </form>
      @endif
      {{-- 게시물 : 끝 --}}
      {{-- 댓글작성 : 시작 --}}
      <div class="flex flex-col w-9/12 mb-10 text-left">
        <form action="{{ route('comment.store') }}" method="post" class="w-full max-w-xl bg-white rounded-lg px-4 pt-2">
          @csrf
          <input type="hidden" value="{{ $posts->id }}" name="post_id">
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
                    <div class="relative mb-1">
                      <strong>{{ $comment->writer }}</strong>
                      <span class="text-xs text-gray-400">
                        {{ $comment->created_at->format('Y/m/d H:i') }}
                        @if ($comment->created_at != $comment->updated_at)
                          (수정됨)
                        @endif
                      </span>
                      @if (Auth::check() && $comment->writer == Auth::user()->name)
                      {{-- 드롭다운 id에 댓글 id를 추가함으로써 각자 다른 드롭다운으로 적용시킨다 --}}
                        <button id="dropdownButton_comment_{{ $comment->id }}" data-dropdown-toggle="dropdown_comment_{{ $comment->id }}" 
                        class="text-gray-600 absolute right-0 mr-4 hover:bg-gray-100 font-medium rounded-full text-sm px-4 py-2.5 text-center inline-flex items-center" 
                        type="button"><i class="fas fa-ellipsis-v"></i></button>
                      <form action="{{ route('comment.delete',['comment' => $comment]) }}" method="post" id="comment_del_{{ $comment->id }}">
                        @csrf
                        @method('DELETE')
                          <div id="dropdown_comment_{{ $comment->id }}" class="hidden z-10 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                            <ul class="py-1 px-1" aria-labelledby="dropdownButton_comment_{{ $comment->id }}">
                              <li>
                                <a onclick="edit({{ $comment->id }})" 
                                href="javascript://" class="block py-2 px-4 text-sm text-gray-700 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">수정</a>
                              </li>
                              <li>
                                <a onclick="del('comment_del_{{ $comment->id }}');" 
                                href='javascript://' class="block py-2 px-4 text-sm text-gray-700 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" >삭제</a>
                              </li>
                            </ul>
                          </div>
                      </form>
                      @endif
                    <p class="text-sm">
                      <form action="{{ route('comment.update',['comment' => $comment]) }}" method="POST" id="">
                        @csrf
                        @method('PATCH')
                        <div class="relative z-0 mb-6 w-full group">
                          <p class="" id="comment_{{ $comment->id }}">{{ $comment->content }}</p>
                          <span name="comment_content" id="comment_content_{{ $comment->id }}" class="hidden flex">
                            <input type="text" name="comment_content" value="{{ $comment->content }}" class="block py-2.5 px-0 w-10/12 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                            <button type="button" onclick="edit_cancel({{ $comment->id }})"><i class="fas fa-times"></i></button>
                            <button type="submit" class="ml-2"><i class="fas fa-level-down-alt fa-rotate-90"></i></button>
                          </span>
                        </div>
                      </form>
                    </p>
                  </div>
                  <div class="mt-4 flex items-center">
                    <div class="text-sm text-gray-500 font-semibold w-full">
                      <p class="hover:underline mb-1" id="reply_{{ $comment->id }}">
                        <a href="javascript:reply_edit({{ $comment->id }})"><i class="fas fa-comment-dots"></i> 답글</a>
                      </p>
                      <span name="reply_content" id="reply_content_{{ $comment->id }}" class="hidden flex">
                        <input type="text" name="reply_content" value="" class="block py-2.5 px-0 w-10/12 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                        <button type="button" onclick="reply_edit_cancel({{ $comment->id }})"><i class="fas fa-times"></i></button>
                        <button type="button" class="ml-2"><i class="fas fa-level-down-alt fa-rotate-90"></i></button>
                      </span>
                      @if ($replys)
                      <p class="hover:underline text-blue-500">
                        <a href="javascript://"><i class="fas fa-chevron-right"></i> 5개의 댓글</a>
                      </p>
                        @foreach ($replys as $reply)
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
                        @endforeach
                      @endif

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
    //게시물 삭제랑 댓글삭제 각자 다른 form에서 submit할수있도록 form id를 매개변수로 받음
    function del(id){
      var con_test = confirm('정말 삭제하시겠습니까?');
      if(con_test == true){
        document.getElementById(id).submit();
      }
      else if(con_test == false){
        return;
      }
    }
    //수정버튼을 누른 댓글이 input이 활성화되도록 id를 매개변수로 받음
    function edit(id){
      document.getElementById('comment_'+id).classList.add('hidden');
      document.getElementById('comment_content_'+id).classList.remove('hidden');
    }
    function reply_edit(id){
      document.getElementById('reply_'+id).classList.add('hidden');
      document.getElementById('reply_content_'+id).classList.remove('hidden');
    }
    //수정취소
    function edit_cancel(id){
      document.getElementById('comment_'+id).classList.remove('hidden');
      document.getElementById('comment_content_'+id).classList.add('hidden');
    }
    function reply_edit_cancel(id){
      document.getElementById('reply_'+id).classList.remove('hidden');
      document.getElementById('reply_content_'+id).classList.add('hidden');
    }
  </script>
@endsection