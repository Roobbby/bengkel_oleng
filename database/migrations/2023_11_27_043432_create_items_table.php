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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('domain_id');
            $table->foreign('domain_id')->references('id')->on('domains')->nullable();
            $table->string('nama_barang')->nullable();
            $table->unsignedBigInteger('id_category')->nullable();
            $table->string('category')->nullable();
            $table->string('cover')->nullable();
            $table->string('images')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('stok')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
