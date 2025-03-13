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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');                         // Relasi ke posts
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');            // Relasi ke users (bisa null)
            $table->text('content');                                                                  // Isi komentar
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // Untuk reply komentar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
