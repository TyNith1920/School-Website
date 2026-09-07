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
    Schema::table('campuses', function (Blueprint $table) {
        // ប្តូរពី string មកជា text ដើម្បីផ្ទុកកូដ embed វែងៗបាន
        $table->text('video_url')->change();
        $table->text('map_embed_url')->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campuses', function (Blueprint $table) {
            //
        });
    }
};
