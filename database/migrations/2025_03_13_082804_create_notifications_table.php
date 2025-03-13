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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');            // Pemilik postingan
            $table->foreignId('notifier_id')->constrained('users')->onDelete('cascade'); // User yang membookmark
            $table->foreignId('post_id')->constrained()->onDelete('cascade');            // Postingan yang dibookmark
            $table->boolean('is_read')->default(false);                                  // Status baca notifikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
