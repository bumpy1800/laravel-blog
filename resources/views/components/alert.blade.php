{{-- Message --}}
{{-- controller에서 return redirect()->back()->with('error', '회원정보가 일치하지 않습니다!!'); 로 성공여부와 메시지를 넘긴다
 --}} 
 @if (Session::has('success'))
 <div class="bg-green-300 mb-2 p-2 alert alert-success alert-dismissible" role="alert" id="alert" style="">
     <button type="button" class="close" data-dismiss="alert" id="close">
         <i class="fa fa-times"></i>
     </button>
     <strong>Success !</strong> {{ session('success') }}
 </div>
@endif

@if (Session::has('error'))
 <div class="bg-rose-400 mb-2 p-2 alert alert-danger alert-dismissible" role="alert" id="alert" style="">
     <button type="button" class="close" data-dismiss="alert" id="close">
         <i class="fa fa-times"></i>
     </button>
     <strong>Error !</strong> {{ session('error') }}
 </div>
@endif


<script type="text/javascript">
 document.getElementById("close").addEventListener("click",Hide);

 function Hide(){
   document.getElementById('alert').style.display = "none";
 };
</script>