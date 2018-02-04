<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('author_id');
            $table->enum('type', ['attachment', 'page', 'post']);
            $table->string('mime_type', 100);
            $table->enum('status', ['draft', 'publish', 'trash'])->default('publish');
            $table->enum('comment_status', ['closed', 'open'])->default('open');
            $table->bigInteger('comment_count')->default('0');
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
        Schema::dropIfExists('posts');
    }
}
