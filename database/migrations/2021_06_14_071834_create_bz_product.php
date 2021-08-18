<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cat_number', 255)->unique();
            $table->string('brand', 255);
            $table->string('nama_produk', 255);
            $table->string('host', 255);
            $table->string('reactivity', 255);
            $table->string('clone_type', 255);
            $table->string('application', 255);
            $table->string('pack_size', 255);
            $table->string('type_product', 255);
            $table->integer('price');
            $table->float('disc');
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
        Schema::dropIfExists('bz_product');
    }
}
