<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('borrow_requests')) {
            Schema::create('borrow_requests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
                $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->text('note')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('borrow_requests');
    }
};
