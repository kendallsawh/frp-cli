<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficerParcelVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officer_parcel_verification', function (Blueprint $table) {
            $table->integer('parcel_veri_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['parcel_veri_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officer_parcel_verification');
    }
}
