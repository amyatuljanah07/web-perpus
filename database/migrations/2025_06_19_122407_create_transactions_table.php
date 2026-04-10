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
        
    Schema::create('transactions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('siswa_id')->constrained('users');
    $table->foreignId('buku_id')->constrained('books');
    $table->date('tanggal_pinjam');
    $table->date('tanggal_jatuh_tempo'); // dipilih siswa saat pinjam
    $table->date('tanggal_dikembalikan')->nullable(); // otomatis saat siswa return
    $table->enum('status', ['Sedang Dipinjam', 'Returned'])->default('Sedang Dipinjam');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
