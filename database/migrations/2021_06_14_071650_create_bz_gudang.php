<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzGudang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_gudang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_gudang', 255)->unique();
            $table->string('cat_number', 255);
            $table->string('brand', 255);
            $table->string('nama_produk', 255);
            $table->string('lot_number', 255)->unique();
            $table->string('ED', 255);
            $table->integer('stock');
            $table->text('note', 255);
            $table->string('harga_beli', 255);
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
        Schema::dropIfExists('bz_gudang');
    }
}
