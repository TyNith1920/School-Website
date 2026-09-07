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
        Schema::table('history_settings', function (Blueprint $table) {
            // បន្ថែមប្រអប់ JSON ដើម្បីអាចផ្ទុកទិន្នន័យបានច្រើនជួរ
            $table->json('banner_slider')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_settings', function (Blueprint $table) {
            //
        });
    }
};
