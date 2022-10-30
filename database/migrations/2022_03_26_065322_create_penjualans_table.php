<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meja_id');
            $table->unsignedBigInteger('waiters_id');
            $table->unsignedBigInteger('kasir_id');
            $table->integer('total_item');
            $table->integer('total_harga');
            $table->integer('bayar')->default(0)->change();
            $table->integer('diterima')->default(0)->change();
            $table->enum('status', ['Sudah Bayar', 'Belum Bayar'])->default('Belum Bayar')->change();
            $table->foreign('meja_id')->references('id')->on('mejas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('waiters_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('kasir_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('penjualans');
    }
}
