<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_badges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('farmer_badge');
            $table->date('date_issued');
            $table->integer('farmer_id')->unsigned()->unique();
            $table->integer('colour_id')->unsigned()->default(1);
            $table->integer('user_id')->unsigned();
            $table->boolean('valid')->default(0);
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
        Schema::dropIfExists('farmer_badges');
    }
}
