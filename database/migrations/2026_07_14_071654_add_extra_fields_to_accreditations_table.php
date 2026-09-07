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
        Schema::table('accreditations', function (Blueprint $table) {
            // បន្ថែមប្រអប់សម្រាប់ដាក់រូបលិខិតបញ្ជាក់ (Document)
            $table->string('document_image')->nullable();
            
            // បន្ថែមប្រអប់សម្រាប់ដាក់រូបភាពសកម្មភាពច្រើនសន្លឹក (Gallery)
            $table->json('gallery')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accreditations', function (Blueprint $table) {
            //
        });
    }
};
