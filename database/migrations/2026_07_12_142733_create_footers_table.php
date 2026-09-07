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
    Schema::create('footers', function (Blueprint $table) {
        $table->id();
        $table->string('weekdays_time')->default('08:00am–04:00pm');
        $table->string('weekend_time')->default('08:00am-11:30am');
        $table->string('telegram')->default('(+855) 78-517-754');
        $table->string('phone')->default('(+855) 10-595-922');
        $table->string('email')->default('admin@life.edu.kh');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
