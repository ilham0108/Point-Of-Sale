<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->string('nama', 255);
            $table->string('institution', 255);
            $table->string('department', 255);
            $table->string('subdepartment', 255);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->string('postcode', 255);
            $table->string('phone', 255);
            $table->string('fax', 255);
            $table->string('contactperson', 255);
            $table->string('title', 255);
            $table->string('email', 255);
            $table->string('note', 255);
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
        Schema::dropIfExists('bz_customer');
    }
}
