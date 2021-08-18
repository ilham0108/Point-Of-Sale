<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode', 255)->unique();
            $table->string('no_po', 255);
            $table->string('kode_gudang', 255);
            $table->string('harga_jual', 255);
            $table->date('tgl_jual');
            $table->string('nama_sales', 255);
            $table->integer('qty');
            $table->string('customer', 255);
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
        Schema::dropIfExists('bz_penjualan');
    }
}
