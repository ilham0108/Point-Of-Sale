<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBzQuotation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bz_quotation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user');
            $table->string('kode_quotation', 255)->unique();
            $table->string('nama_sales', 255);
            $table->string('id_customer', 255);
            $table->string('diskon2', 255);
            $table->string('payment', 255);
            $table->date('validity_qtt');
            $table->string('delivert_time');
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
        Schema::dropIfExists('bz_quotation');
    }
}
