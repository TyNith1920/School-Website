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
    Schema::create('student_lives', function (Blueprint $table) {
        $table->id();
        $table->string('title')->default('STUDENT LIFE');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->string('link')->nullable(); // សម្រាប់ប៊ូតុង More About Student Life
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_lives');
    }
};
