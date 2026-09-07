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
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->string('year'); // ឆ្នាំ (ឧទាហរណ៍៖ 2007)
            $table->text('description'); // អត្ថបទពណ៌នាព្រឹត្តិការណ៍
            $table->string('color')->default('blue'); // ពណ៌តំណាងឆ្នាំនីមួយៗ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
