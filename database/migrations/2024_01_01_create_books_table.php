<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('category');
            $table->string('genre')->nullable();
            $table->string('status')->default('Tersedia');
            $table->integer('year')->nullable();
            $table->integer('stock')->default(1);
            $table->integer('pages')->nullable();
            $table->text('synopsis')->nullable(); // Make synopsis optional
            $table->string('cover_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};
