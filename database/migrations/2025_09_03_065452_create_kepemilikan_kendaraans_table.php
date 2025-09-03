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
        Schema::create('kepemilikan_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asn_id')->constrained('asns')->onDelete('cascade');
            $table->foreignId('kendaraan_id')->constrained('kendaraans')->onDelete('cascade');
            $table->date('tanggal_mulai')->nullable(); // mulai digunakan
            $table->date('tanggal_selesai')->nullable(); // jika sudah tidak digunakan
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepemilikan_kendaraans');
    }
};
