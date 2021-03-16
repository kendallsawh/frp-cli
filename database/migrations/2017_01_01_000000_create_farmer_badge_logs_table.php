<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerBadgeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_badge_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_issued');
            $table->integer('badge_id')->unsigned();
            $table->integer('colour_id')->unsigned();
            $table->integer('issued_by')->unsigned();
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
        Schema::dropIfExists('farmer_badge_logs');
    }
}
