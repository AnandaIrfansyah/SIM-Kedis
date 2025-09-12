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
        Schema::create('pemeliharaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('kendaraans')->onDelete('cascade');

            $table->foreignId('bengkel_id')->nullable()->constrained('bengkels')->nullOnDelete();

            $table->string('nama_bengkel_manual')->nullable();
            $table->string('alamat_bengkel_manual')->nullable();

            $table->string('nomor_nota')->nullable();
            $table->date('tanggal_pemeliharaan')->nullable();
            $table->integer('kilometer')->nullable();
            $table->text('uraian')->nullable();
            $table->decimal('biaya', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('jenis_pemeliharaan', ['suku cadang', 'pelumas', 'servis'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeliharaans');
    }
};
