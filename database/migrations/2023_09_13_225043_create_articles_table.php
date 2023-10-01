<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('投稿者ID');
            $table->string('title')->comment('投稿タイトル');
            $table->string('tag')->comment('投稿タグ');
            $table->string('image')->nullable()->comment('投稿画像');
            $table->text('body')->comment('投稿内容');
            $table->string('store')->nullable();
            $table->string('address')->nullable();
            $table->integer('recommend')->comment('評価');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
