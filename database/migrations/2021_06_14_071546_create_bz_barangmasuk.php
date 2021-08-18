<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzBarangmasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_barangmasuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_masuk', 255);
            $table->string('cat_number', 255);
            $table->string('no_po', 255);
            $table->string('brand', 255);
            $table->string('lot_number', 255);
            $table->string('ed', 255);
            $table->Integer('qty');
            $table->Integer('price');
            $table->date('date');
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
        Schema::dropIfExists('bz_barangmasuk');
    }
}
