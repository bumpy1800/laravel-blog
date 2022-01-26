@if(Session::has('status'))
<script type="text/javascript">

    alert("{{ session()->get('status') }}");

</script>
@endif

<div class="logo">
  <h1 class="text-white ml-4 cursor-pointer text-2xl">Laravel-Blog</h1>
</div>
<div class="pt-2 relative mx-auto text-gray-600">
  <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
    type="search" name="search" placeholder="Search">
  <button type="submit" class="absolute right-0 top-0 mt-5 mr-4">
    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
      viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
      width="512px" height="512px">
      <path
        d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
    </svg>
  </button>
</div>
<ul class="flex items-center">
{{-- 로그인 여부에 따라 navbar가 달라짐 --}}
@if (Auth::check())
<li>
  <button id="dropdownButton" data-dropdown-toggle="dropdown" class="text-white mr-4 bg-gray-800 hover:bg-gray-700 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    {{ Auth::user()->name }}
    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
  </button>
</li>
<!-- Dropdown menu -->
<div id="dropdown" class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
    <ul class="py-1" aria-labelledby="dropdownButton">
      <li>
        <a href="{{ route('userinfo.show') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">내정보</a>
      </li>
      <li>
        <a href="{{ route('logout') }}" class="block py-2 px-4 text-sm text-gray-700 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" >로그아웃</a>
      </li>
    </ul>
</div>
<li>
  <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="{{ route('posts.create') }}" style="
">글쓰기</a>
</li>
@else
<li>
  <a class="text-white mr-4 bg-gray-500 pt-4 pb-4 pr-5 pl-5 hover:bg-gray-600 transition-all rounded" href="{{ route('login.index') }}" style="
">로그인</a>
</li>
@endif
</ul>

  {{-- tailwind dropdown 이나 modal같은 기능작용 --}}
<script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>