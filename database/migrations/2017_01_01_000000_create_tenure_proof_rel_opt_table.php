<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenureProofRelOptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenure_proof_rel_opt', function (Blueprint $table) {
            $table->integer('app_id')->unsigned();
            $table->integer('land_id')->unsigned();
            $table->integer('tenure_id')->unsigned();
            $table->integer('proof_id')->unsigned();
            $table->boolean('conditional')->default('0');
            $table->primary(['app_id', 'land_id', 'tenure_id', 'proof_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenure_proof_rel_opt');
    }
}
