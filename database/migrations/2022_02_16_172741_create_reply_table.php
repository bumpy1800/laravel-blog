<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('reply');
        Schema::create('reply', function (Blueprint $table) {
            $table->id();
            $table->string('content');// 내용
            $table->string('writer'); // 작성자
            $table->string('comment_id');// 어느 댓글의 대댓글인지
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
        Schema::dropIfExists('reply');
    }
}
