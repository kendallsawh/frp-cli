<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelTypesOfProduceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_types_of_produce', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parcel_id')->unsigned();
            $table->integer('parcel_type_id')->unsigned();
            $table->string('specific_parcel');
            $table->decimal('amt', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcel_types_of_produce');
    }
}
