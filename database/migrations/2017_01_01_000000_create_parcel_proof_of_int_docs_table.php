<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelProofOfIntDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_proof_of_int_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parcel_proof_of_int_id')->unsigned();
            $table->string('document');
            $table->string('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcel_proof_of_int_docs');
    }
}
