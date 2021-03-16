<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys5 extends Migration {

	public function up()
	{
		Schema::table('enterprise_other', function(Blueprint $table) {
			$table->foreign('application_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parcel_proof_of_int_docs', function(Blueprint $table) {
			$table->foreign('parcel_proof_of_int_id')->references('id')->on('parcel_proof_of_interest')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('wards', function(Blueprint $table) {
			$table->foreign('county_id')->references('id')->on('counties')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('districts', function(Blueprint $table) {
			$table->foreign('ward_id')->references('id')->on('wards')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parcel_types', function(Blueprint $table) {
			$table->foreign('parcel_unit_id')->references('id')->on('parcel_units')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('enterprise_other', function(Blueprint $table) {
			$table->dropForeign('enterprise_other_application_id_foreign');
		});

		Schema::table('parcel_proof_of_int_docs', function(Blueprint $table) {
			$table->dropForeign('parcel_proof_of_int_docs_parcel_proof_of_int_id_foreign');
		});

		Schema::table('wards', function(Blueprint $table) {
			$table->dropForeign('wards_county_id_foreign');
		});

		Schema::table('districts', function(Blueprint $table) {
			$table->dropForeign('districts_ward_id_foreign');
		});

		Schema::table('parcel_types', function(Blueprint $table) {
			$table->dropForeign('parcel_types_parcel_unit_id_foreign');
		});

	}
}