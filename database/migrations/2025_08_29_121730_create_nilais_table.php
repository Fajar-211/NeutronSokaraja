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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained(
                table: 'siswas', indexName: 'nilai_siswa_id'
            );
            $table->foreignId('pengajar_id')->constrained(
                table: 'users', indexName: 'nilai_user_id'
            );
            $table->foreignId('mapel_id')->constrained(
                table: 'mapels', indexName: 'nilai_mapel_id'
            );
            $table->decimal('nilai');
            $table->date('tanggal');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
