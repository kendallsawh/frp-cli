<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('old_registration_num')->nullable();
            $table->string('application_num')->nullable();
            $table->integer('app_type_id')->unsigned();
            $table->integer('registration_id')->unsigned();            
            $table->integer('created_by')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);
            $table->integer('untenanted')->unsigned()->default(0);
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
        Schema::dropIfExists('applications');
    }
}
