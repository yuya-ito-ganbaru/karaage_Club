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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->unique();
            $table->integer('count')->default(0)->comment('いいねカウント');
            $table->timestamps();
            $table->foreign('article_id')->references('id')->on('articles')->cascadeOnDelete()->comment('article_idはarticlesテーブルID');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
