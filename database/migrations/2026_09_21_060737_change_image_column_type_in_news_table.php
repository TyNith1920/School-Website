<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // ប្តូរ column image ទៅជា text ឬ json ដើម្បីផ្ទុកឈ្មោះរូបភាពបានច្រើនសន្លឹក
            $table->text('image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('image', 255)->nullable()->change();
        });
    }
};