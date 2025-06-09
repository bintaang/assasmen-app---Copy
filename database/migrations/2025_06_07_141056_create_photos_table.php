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
      Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('location');
        $table->text('message');
        $table->string('photo_path');
        $table->string('music_path')->nullable(); // untuk file lokal
        $table->text('music_url')->nullable();    // untuk embed/link mp3
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
