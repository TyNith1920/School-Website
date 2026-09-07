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
    Schema::create('site_banners', function (Blueprint $table) {
        $table->id();
        $table->string('page_name'); // ដើម្បីសម្គាល់ថាជារូបសម្រាប់ទំព័រណា (ដូចជា Contact, ECE...)
        $table->string('image_path'); // កន្លែងផ្ទុករូបភាព
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_banners');
    }
};
