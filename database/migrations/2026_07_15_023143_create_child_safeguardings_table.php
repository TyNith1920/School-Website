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
    Schema::create('child_safeguardings', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->text('description')->nullable();
        $table->string('pdf_file')->nullable(); // សម្រាប់ផ្ទុកឯកសារ PDF
        $table->text('video_url')->nullable(); // សម្រាប់កូដវីដេអូ iframe
        $table->string('image_1')->nullable(); // រូបភាពទី ១
        $table->string('image_2')->nullable(); // រូបភាពទី ២
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_safeguardings');
    }
};
