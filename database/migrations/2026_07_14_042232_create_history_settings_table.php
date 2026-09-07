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
        Schema::create('history_settings', function (Blueprint $table) {
            $table->id();
            $table->text('vision')->nullable(); // ចក្ខុវិស័យ
            $table->text('mission')->nullable(); // បេសកកម្ម
            $table->string('founder_image')->nullable(); // រូបថតស្ថាបនិក
            $table->text('founder_message')->nullable(); // អត្ថបទសារស្ថាបនិក
            $table->string('founder_blessing')->nullable(); // ពាក្យជូនពរ (ឧ: May The Lord...)
            $table->string('founder_name')->nullable(); // ឈ្មោះស្ថាបនិក
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_settings');
    }
};
