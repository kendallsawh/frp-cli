<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmerBadgeReplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_badge_replacements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comments');
            $table->string('police_report')->nullable();
            $table->integer('replacement_type_id')->unsigned();
            $table->integer('badge_id')->unsigned();
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
        Schema::dropIfExists('farmer_badge_replacements');
    }
}
