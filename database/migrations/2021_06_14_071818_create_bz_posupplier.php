<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzPosupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_posupplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_po', 255)->unique();
            $table->string('id_supplier', 255);
            $table->string('cat_number', 255);
            $table->Integer('qty');
            $table->string('price', 255);
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
        Schema::dropIfExists('bz_posupplier');
    }
}
