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
    Schema::create('campuses', function (Blueprint $table) {
        $table->id();
        $table->string('title')->default('LIS TOUR');
        $table->text('description')->nullable();
        $table->string('video_url')->nullable(); // សម្រាប់ដាក់ Link វីដេអូ
        $table->string('address')->nullable();
        $table->string('phone')->nullable();
        $table->string('map_embed_url')->nullable(); // សម្រាប់ Google Map
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campuses');
    }
};
