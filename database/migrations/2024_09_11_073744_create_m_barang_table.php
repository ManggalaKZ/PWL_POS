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
        Schema::create('m_barang', function (Blueprint $table) {
            $table->bigIncrements('barang_id'); // Menambahkan kolom barang_id
            $table->bigInteger('kategori_id')->unsigned(); // Menambahkan kolom kategori_id
            $table->string('barang_kode', 10); // Menambahkan kolom barang_kode
            $table->string('barang_nama', 100); // Menambahkan kolom barang_nama
            $table->integer('harga_beli'); // Menambahkan kolom harga_beli
            $table->integer('harga_jual'); // Menambahkan kolom harga_jual
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};
