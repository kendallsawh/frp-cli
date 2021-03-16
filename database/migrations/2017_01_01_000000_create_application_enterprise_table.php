<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationEnterpriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_enterprise', function (Blueprint $table) {
            $table->integer('enterprise_id')->unsigned();
            $table->integer('application_id')->unsigned();
            $table->string('type');
            $table->primary(['enterprise_id', 'application_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_enterprise');
    }
}
