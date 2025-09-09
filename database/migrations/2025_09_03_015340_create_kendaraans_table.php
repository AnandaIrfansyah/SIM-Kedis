<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('tipe')->nullable();
            $table->string('no_polisi')->unique();
            $table->string('no_rangka')->nullable()->unique();
            $table->string('no_mesin')->nullable()->unique();
            $table->string('no_bpkb')->nullable()->unique();
            $table->integer('tahun')->nullable();
            $table->string('jenis')->nullable();
            $table->date('jatuh_tempo_pajak')->nullable();
            $table->date('jatuh_tempo_stnk')->nullable();
            $table->string('foto')->nullable();
            $table->string('qr_code')->unique()->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
