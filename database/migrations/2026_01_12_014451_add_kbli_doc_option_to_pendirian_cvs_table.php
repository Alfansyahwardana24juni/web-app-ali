<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendirian_cvs', function (Blueprint $table) {
            $table->string('kbli_doc_option')->nullable()->after('kbli_selected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendirian_cvs', function (Blueprint $table) {
            $table->dropColumn('kbli_doc_option');
        });
    }
};
