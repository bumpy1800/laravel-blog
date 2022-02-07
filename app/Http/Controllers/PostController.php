<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['store', 'update', 'edit', 'create', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //최근에 올라온 게시물 순으로 5개씩 가져오기
        $post = Post::orderby('created_at', 'desc')->paginate(5);

        //검색했는지 keyword변수의 유무로 판단하기에 null값을 넘겨줘서 구분
        return view('main',[
            'posts' => $post,
            'keyword' => null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.post_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //유효성 검사
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'editor' => 'required',
        ]);

        //엘로퀀트ORM이용해서 insert
        $post = Post::create([
            'title' => $validatedData['title'],
            'writer' => Auth::user()->name,
            'content' => $validatedData['editor'],
        ]);
        if(!is_null($post)){
            return redirect()->route('main')->with('status', '포스팅이 완료되었습니다.');
        }
        else{
            return redirect()->back()->with('status', '포스팅에 실패했습니다.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //post 모델객체 자체를 매개변수로 받기때문에 db에서 값을 가져올 필요가없음
        return view('posts.post_detail',['posts' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //post 모델객체 자체를 매개변수로 받기때문에 db에서 값을 가져올 필요가없음
        return view('posts.post_edit',['posts' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //유효성 검사
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'editor' => 'required',
        ]);

        //정보 수정
        $posts = Post::find($post->id);
        $posts->title = $validatedData['title'];
        $posts->content = $validatedData['editor'];
        $posts->save();

        if(!is_null($posts)){
            return redirect()->route('main')->with('status', '수정이 완료되었습니다.');
        }
        else{
            return redirect()->back()->with('status', '수정에 실패했습니다.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $posts = Post::find($post->id);
        $posts->delete();

        if(!is_null($posts)){
            return redirect()->route('main')->with('status', '게시글이 삭제되었습니다');
        }
        else{
            return redirect()->back()->with('status', '오류로인해 삭제되지않았습니다');
        }
    }

    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->move('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/uploads/'.$filenametostore);
            $message = 'File uploaded successfully';
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$message')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $result;
        }
    }

    public function search(Request $request){
        //검색 키워드로 scout을 활용하여 검색
        $keyword = $request->search;
        $post = Post::search($keyword)->paginate(5);

        //검색결과와 검색 키워드를 넘긴다 사실상 검색했는지에 대한 확인용 변수 느낌
        return view('main',[
            'posts' => $post,
            'keyword' => $keyword
        ]);
    }
}
