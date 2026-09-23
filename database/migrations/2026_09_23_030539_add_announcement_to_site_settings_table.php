<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('show_announcement')->default(true);
            $table->string('announcement_badge')->nullable()->default('ANNOUNCEMENT');
            $table->text('announcement_text')->nullable()->default('Welcome to Life International School! Admissions are now open for the upcoming academic year.');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['show_announcement', 'announcement_badge', 'announcement_text']);
        });
    }
};