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
        Schema::create('accreditations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ឈ្មោះស្ថាប័ន
            $table->string('logo')->nullable(); // ឡូហ្គោស្ថាប័ន
            $table->text('description')->nullable(); // ការពិពណ៌នា
            $table->string('website_link')->nullable(); // តំណភ្ជាប់ទៅវេបសាយគេ (បើសិនជាមាន)
            $table->integer('sort_order')->default(0); // លេខរៀង
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accreditations');
    }
};
