<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parcel_id')->unsigned();
            $table->string('recommend_sal');
            $table->string('cabnote');
            $table->string('occupation_years');
            $table->string('uprn')->nullable();
            $table->text('remarks');
            $table->integer('verification_ent_id')->unsigned();
            $table->decimal('plot_size', 10, 2);
            $table->integer('percent_cultivated');
            $table->boolean('recommended');
            $table->integer('user_id')->unsigned();
            $table->boolean('flagged');
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
        Schema::dropIfExists('parcel_verification');
    }
}
