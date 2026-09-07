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
    Schema::create('why_choose_us', function (Blueprint $table) {
        $table->id();
        $table->string('image')->nullable(); // សម្រាប់ដាក់រូប Icon តូចៗ
        $table->string('title'); // ចំណងជើង (ឧ. Student/Teacher Ratio)
        $table->text('description')->nullable(); // អត្ថបទពណ៌នា
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_choose_us');
    }
};
