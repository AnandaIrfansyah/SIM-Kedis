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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_qr')->unique();
            $table->string('plat_nomor')->unique();
            $table->string('jenis');
            $table->string('merk');
            $table->string('warna');
            $table->year('tahun')->nullable();
            $table->string('nomor_rangka')->unique();
            $table->string('nomor_mesin')->unique();
            $table->string('nomor_bpkb')->unique();
            $table->string('pemegang')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->date('jatuh_tempo_pajak_tahunan')->nullable();
            $table->date('jatuh_tempo_stnk')->nullable();
            $table->enum('status', ['Aktif', 'Nonaktif', 'Perawatan'])->default('Aktif');
            $table->string('foto_kendaraan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
