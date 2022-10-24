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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama_prod');
            $table->string('kode_prod')->unique();
            $table->string('merk_prod')->nullable();
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('diskon')->default(0);
            $table->integer('stok')->default(0);
            $table->string('ket')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->cascadeOnDelete()->cascadeOnUpdate();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('produks');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
