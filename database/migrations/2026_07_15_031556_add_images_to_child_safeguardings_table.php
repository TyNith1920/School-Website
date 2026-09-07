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
    Schema::table('child_safeguardings', function (Blueprint $table) {
        // បង្កើត Column ថ្មីប្រភេទ JSON ដើម្បីផ្ទុករូបភាពច្រើន
        $table->json('images')->nullable(); 
    });
}

public function down(): void
{
    Schema::table('child_safeguardings', function (Blueprint $table) {
        $table->dropColumn('images');
    });
}
};
