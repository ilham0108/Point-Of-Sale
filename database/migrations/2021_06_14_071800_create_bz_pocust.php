<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzPocust extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_pocust', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_po', 255)->unique();
            $table->string('no_pocust', 255);
            $table->string('cat_number', 255);
            $table->Integer('qty');
            $table->Integer('price');
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
        Schema::dropIfExists('bz_pocust');
    }
}
