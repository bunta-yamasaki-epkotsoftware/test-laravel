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
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // いいねは投稿に属すると仮定する
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // いいねはユーザーに属すると仮定する
            $table->timestamps();

            $table->unique(['post_id', 'user_id']); // ユーザーが同じ投稿に複数回いいねできないようにする)
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
