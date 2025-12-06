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
        Schema::create('temporary_nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('siswa_id');
            $table->foreignId('mapel_id');
            $table->date('tanggal');
            $table->string('absensi')->default('Tidak hadir');
            $table->text('sumary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_nilais');
    }
};
