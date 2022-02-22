<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
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
            'content' => 'required|max:100',
        ]);

        //엘로퀀트ORM이용해서 insert
        $comment = Comment::create([
            'content' => $validatedData['content'],
            'writer' => Auth::user()->name,
            'post_id' => $request->input('post_id'),
        ]);
        if(!is_null($comment)){
            return redirect()->back()->with('status', '댓글이 등록되었습니다.');
        }
        else{
            return redirect()->back()->with('status', '댓글 등록에 실패했습니다.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //유효성 검사
        $validatedData = $request->validate([
            'comment_content' => 'required|max:100',
        ]);

        //update
        $comments = Comment::find($comment->id);

        $comments->content = $validatedData['comment_content'];

        $comments->save();

        if(!is_null($comments)){
            return redirect()->back()->with('status', '댓글이 수정되었습니다.');
        }
        else{
            return redirect()->back()->with('status', '댓글 수정에 실패했습니다.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        if(!is_null($comment)){
            return redirect()->back()->with('status', '댓글이 삭제되었습니다');
        }
        else{
            return redirect()->back()->with('status', '댓글 삭제에 실패했습니다');
        }
    }

    public function reply_store(Request $request){
        
        //유효성 검사
        $validatedData = $request->validate([
            'reply_content' => 'required|max:100',
        ]);

        //엘로퀀트ORM이용해서 insert
        $replys = Reply::create([
            'content' => $validatedData['reply_content'],
            'writer' => Auth::user()->name,
            'comment_id' => $request->input('comment_id'),
        ]);

        if(!is_null($replys)){
            return redirect()->back()->with('status', '대댓글 작성에 성공했습니다');
        }
        else{
            return redirect()->back()->with('status', '대댓글 작성에 실패했습니다');
        }
    }

    public function reply_update(Request $request){
        //유효성 검사
        $validatedData = $request->validate([
            'reply_content' => 'required|max:100',
        ]);

        //update
        $replys = Reply::find($request->input('id'));

        $replys->content = $validatedData['reply_content'];

        $replys->save();

        if(!is_null($replys)){
            return response()->json(array('reply'=> $replys), 200);
        }
        else{
            return redirect()->back()->with('status', '대댓글 수정에 실패했습니다.');
        }
    }

    public function reply_destroy(Request $request){

        $replys = Reply::find($request->input('id'));

        $replys->delete();

        if(!is_null($replys)){
            return response()->json(array('reply'=> $replys), 200);
        }
        else{
            return redirect()->back()->with('status', '대댓글 수정에 실패했습니다.');
        }
    }
}
