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
    Schema::create('pages', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // ចំណងជើងទំព័រ
        $table->string('slug')->unique(); // សម្រាប់ធ្វើជា Link (ឧទាហរណ៍ ece)
        $table->longText('content')->nullable(); // អត្ថបទ (អាចមានទំហំវែង)
        $table->string('image')->nullable(); // រូបភាពតំណាងទំព័រ
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
