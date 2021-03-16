<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organization_name');
            $table->string('organization_type');
            $table->string('logo')->default('blank-img.png');
            $table->string('registration_num')->unique();
            $table->string('vat_reg_num')->unique();
            $table->string('email');
            $table->integer('contact_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->integer('created_by')->unsigned();
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
        Schema::dropIfExists('organizations');
    }
}
