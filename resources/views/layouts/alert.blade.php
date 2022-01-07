{{-- Message --}}
{{-- @include('layouts.alert') 를 view파일에 사용하고 
controller에서 return redirect()->back()->with('error', '회원정보가 일치하지 않습니다!!'); 로 성공여부와 메시지를 넘긴다
부트스트랩 필요
 --}} 
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Success !</strong> {{ session('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>Error !</strong> {{ session('error') }}
    </div>
@endif