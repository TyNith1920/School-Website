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
    Schema::table('student_lives', function (Blueprint $table) {
        // បន្ថែម Column ថ្មីប្រភេទ json ដើម្បីផ្ទុករូបភាពច្រើន
        $table->json('gallery_images')->nullable(); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_lives', function (Blueprint $table) {
            //
        });
    }
};
