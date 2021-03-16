<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppLandTenureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_land_tenure', function (Blueprint $table) {
            $table->integer('app_id')->unsigned();
            $table->integer('land_id')->unsigned();
            $table->integer('tenure_id')->unsigned();
            $table->primary(['app_id', 'land_id', 'tenure_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_land_tenure');
    }
}
