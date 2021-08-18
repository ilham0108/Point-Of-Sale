<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_supplier', 255)->unique();
            $table->string('brand', 255);
            $table->string('address', 255);
            $table->string('phone', 255);
            $table->string('fax', 255);
            $table->string('contact_person', 255);
            $table->string('email', 255);
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
        Schema::dropIfExists('bz_supplier');
    }
}
