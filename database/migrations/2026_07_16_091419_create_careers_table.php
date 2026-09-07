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
    Schema::create('careers', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // ចំណងជើងការងារ (ឧ. គ្រូបង្រៀនគណិតវិទ្យា)
        $table->string('job_type')->nullable(); // ប្រភេទការងារ (ឧ. Full-time / Part-time)
        $table->longText('description')->nullable(); // ការពិពណ៌នាការងារ និងលក្ខខណ្ឌ
        $table->string('application_file')->nullable(); // ឯកសារ PDF ពាក្យសុំធ្វើការ
        $table->boolean('is_active')->default(true); // សម្រាប់បិទ/បើក ការប្រកាសរើស
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
