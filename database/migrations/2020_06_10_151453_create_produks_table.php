<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->nullable()->unique();
            $table->text('gambar');
            $table->string('kode_barang');
            $table->string('nama');
            $table->text('permalink')->unique();
            $table->string('berat');
            $table->string('harga');
            $table->string('stock');
            $table->text('deskripsi');
            $table->string('warna');
            $table->boolean('is_diskon')->default(false);
            $table->string('diskon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}