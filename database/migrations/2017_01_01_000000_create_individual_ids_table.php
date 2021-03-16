<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualIDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_ids', function (Blueprint $table) {
            $table->integer('individual_id')->unsigned();
            $table->integer('id_type_id')->unsigned();
            $table->string('id_num');
            $table->primary(['individual_id', 'id_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individual_ids');
    }
}
