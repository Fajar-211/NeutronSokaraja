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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->foreignId('pengajar_id')->constrained(
                table: 'users', indexName: 'schedules_user_id'
            );
            $table->foreignId('mapel_id')->constrained(
                table: 'mapels', indexName: 'scheules_mapel_id'
            );
            $table->foreignId('kelas_id')->constrained(
                table: 'kelas', indexName: 'schedules_kelas_id'
            );
            $table->foreignId('jam_id')->constrained(
                table: 'jams', indexName: 'schedules_jam_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
