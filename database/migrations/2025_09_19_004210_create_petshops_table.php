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
        Schema::create('petshops', function (Blueprint $table) {
            $table->id();
            $table->string("merk_makanan");
            $table->enum("jenis_makanan",["dry food","wet food"]);
            $table->tinyInteger("harga_makanan")->unsigned();
            $table->string("gambar_makanan");
            $table->string("deskripsi_makanan");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petshops');
    }
};
