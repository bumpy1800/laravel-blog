<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('comment');
        Schema::create('comment', function (Blueprint $table) {
            $table->id(); // 댓글 인덱스
            $table->string('content'); // 내용
            $table->string('writer'); // 작성자
            $table->integer('post_id'); // 어느 게시물의 댓글인지
            $table->integer('comment_id')->nullable(); // 어느 댓글의 대댓글인지(null이면 댓글임)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
