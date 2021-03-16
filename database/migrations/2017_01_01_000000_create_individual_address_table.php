<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_address', function (Blueprint $table) {
            $table->integer('ind_id')->unsigned();
            $table->integer('add_id')->unsigned();
            $table->integer('ind_add_type_id')->unsigned();
            $table->primary(['ind_id', 'add_id', 'ind_add_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_address');
    }
}
