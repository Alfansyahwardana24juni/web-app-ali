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
        Schema::create('pendirian_cvs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->text('alamat_lengkap');
            $table->string('kode_pos');
            
            // Menyimpan data direktur dalam format JSON
            $table->json('direktur_data')->nullable();
            
            // Menyimpan data komisaris dalam format JSON
            $table->json('komisaris_data')->nullable();
            
            // Menyimpan data KBLI yang dipilih dalam format JSON
            $table->json('kbli_selected')->nullable();
            
            // Bank yang dipilih
            $table->string('selected_bank')->nullable();
            
            // Path untuk bukti pembayaran
            $table->string('payment_proof_path')->nullable();
            
            // Status pengajuan (pending, diproses, selesai, dll)
            $table->string('status')->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendirian_cvs');
    }
};