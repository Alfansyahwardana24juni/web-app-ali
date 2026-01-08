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
    if (!Schema::hasTable('kbli')) {
        Schema::create('kbli', function (Blueprint $table) {
            $table->integer('KODE');
            $table->string('JUDUL', 512);
            $table->string('URAIAN', 512);
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbli');
    }
};
