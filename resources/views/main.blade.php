@extends('layouts.main')

@section('main_content')
<div class="overflow-x-hidden bg-gray-100">
  <div class="px-6 py-8">
      <div class="container flex justify-between mx-auto">
          <div class="w-full lg:w-8/12">
              <div class="flex items-center justify-between">
                  <h1 class="text-xl font-bold text-gray-700 md:text-2xl">전체글</h1>
              </div>
              @foreach ($posts as $post)
                @php
                //태그가 포함되어서 저장되기때문에 출력할땐 태그 삭제(사진이 리스트에서 안보이는 효과도 줌)
                    $content = $post->content;
                    $content = strip_tags($content);
                @endphp
                <div class="mt-6">
                    <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                        <div class="flex items-center justify-between">
                            {{-- format()으로 표시할 시간과 날짜 형식을 정함 --}}
                            <span class="font-light text-gray-600">{{ $post->created_at->format('Y/m/d H:i') }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('posts.show',['post' => $post->id]) }}" class="text-2xl font-bold text-gray-700 hover:underline">
                                {{ $post->title }}
                            </a>
                            <p class="truncate mt-2 text-gray-600">
                                {{ $content }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <h1 class="font-bold text-gray-700 hover:underline">{{ $post->writer }}</h1>
                            <h1 class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">댓글 수 : 00</a>
                        </div>
                    </div>
                </div>
              @endforeach
              {{ $posts->links() }}
          </div>
      </div>
  </div>
</div>
@endsection