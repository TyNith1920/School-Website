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
        Schema::table('tuition_fees', function (Blueprint $table) {
            // បន្ថែម Column ថ្មីនៅពីក្រោយ lunch_fee ព្រមទាំងដាក់តម្លៃដើម (Default)
            $table->string('lunch_fee_label')->nullable()->default('LUNCH / SNACK')->after('lunch_fee');
        });
    }

    public function down(): void
    {
        Schema::table('tuition_fees', function (Blueprint $table) {
            $table->dropColumn('lunch_fee_label');
        });
    }
};
