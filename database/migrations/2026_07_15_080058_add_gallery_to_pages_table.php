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
    Schema::table('pages', function (Blueprint $table) {
        // បន្ថែម field gallery ប្រភេទ json សម្រាប់ផ្ទុករូបភាពច្រើន
        $table->json('gallery')->nullable()->after('content');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
};
