@extends('layouts.main')

@section('main_content')
<div class="overflow-x-hidden bg-gray-100">
  <div class="px-6 py-8">
      <div class="container flex justify-between mx-auto">
          <div class="w-full lg:w-8/12">
            {{-- 검색을 했을시와 안했을시로 구분하고 검색했을시 URL에서 변수값을 가져와서 무엇을 검색했는지 알려줌 --}}
            @if ($keyword)
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">"<?=$_GET['search']?>"에 대한 검색 결과</h1>
            @else
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">전체글</h1>
            @endif
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
                            {{-- 컨트롤러에서 post라는 모델객체를 매개변수로받기때문에 id가 아닌 post자체를 넘겨줌 --}}
                            <a href="{{ route('posts.show',['post' => $post]) }}" class="text-2xl font-bold text-gray-700 hover:underline">
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
                {{-- 페이지를 넘길때 URL에 검색 키워드도 같이 넘겨서 상단에 검색키워드를 계속 노출시킨다 --}}
              @if ($keyword)
                {{ $posts->appends(['search' => $_GET['search']])->links() }}  
              @else
              {{-- 검색을 안했을시 --}}
                {{ $posts->links() }}
              @endif

          </div>
      </div>
  </div>
</div>
@endsection