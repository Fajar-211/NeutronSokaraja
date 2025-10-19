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
        Schema::create('utbkscores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained(
                table: 'notes', indexName: 'utbkscores_note_id'
            );
            $table->foreignId('utbk_id')->constrained(
                table: 'utbks', indexName: 'utbkscores_utbk_id'
            );
            $table->decimal('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utbkscores');
    }
};
