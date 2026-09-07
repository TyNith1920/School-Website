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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ឈ្មោះ
            $table->string('position'); // តួនាទី
            $table->string('image')->nullable(); // រូបថត
            $table->integer('sort_order')->default(0); // សម្រាប់រៀបលំដាប់មុនក្រោយ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
