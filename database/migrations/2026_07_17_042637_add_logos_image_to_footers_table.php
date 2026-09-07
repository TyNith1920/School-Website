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
    Schema::table('footers', function (Blueprint $table) {
        $table->string('logos_image')->nullable()->after('email'); // បន្ថែមប្រអប់ផ្ទុករូបភាព
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('footers', function (Blueprint $table) {
            //
        });
    }
};
