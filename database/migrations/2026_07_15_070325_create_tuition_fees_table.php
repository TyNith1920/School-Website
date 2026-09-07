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
    Schema::create('tuition_fees', function (Blueprint $table) {
        $table->id();
        $table->string('category')->nullable(); // ឧទាហរណ៍៖ EARLY LEARNING CENTER
        $table->string('program_name')->nullable(); // ឧទាហរណ៍៖ NURSERY
        $table->string('time_schedule')->nullable(); // ឧទាហរណ៍៖ ( HALF-DAY 8:00-11:30 )
        $table->string('monthly_fee')->nullable(); // ឧទាហរណ៍៖ $160
        $table->string('annual_fee')->nullable(); // ឧទាហរណ៍៖ $1,600
        $table->string('lunch_fee')->nullable(); // ឧទាហរណ៍៖ $30
        $table->string('after_school_fee')->nullable(); // ឧទាហរណ៍៖ $100(Optional)
        $table->string('theme_color')->default('yellow'); // ជម្រើសពណ៌: yellow, green, blue, red, purple
        $table->integer('sort_order')->default(0); // សម្រាប់រៀបលំដាប់មុនក្រោយ
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuition_fees');
    }
};
