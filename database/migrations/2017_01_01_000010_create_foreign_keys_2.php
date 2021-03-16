<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys2 extends Migration {

	public function up()
	{
		Schema::table('farmer_badges', function(Blueprint $table) {
			$table->foreign('farmer_id')->references('id')->on('farmers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('colour_id')->references('id')->on('badge_colours')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('organizations', function(Blueprint $table) {
			$table->foreign('contact_id')->references('id')->on('contacts')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('address_id')->references('id')->on('addresses')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('created_by')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('individuals', function(Blueprint $table) {
			$table->foreign('gender_slug')->references('slug')->on('genders')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('created_by')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('contacts', function(Blueprint $table) {
			$table->foreign('contact_type_id')->references('id')->on('contact_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('representatives', function(Blueprint $table) {
			$table->foreign('contact_id')->references('id')->on('contacts')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('id_type_id')->references('id')->on('identification_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parcel_proof_of_interest', function(Blueprint $table) {
			$table->foreign('parcel_id')->references('id')->on('parcels')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('proof_of_int_id')->references('id')->on('proof_of_interest_codes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('farmer_badges', function(Blueprint $table) {
			$table->dropForeign('farmer_badges_farmer_id_foreign');
			$table->dropForeign('farmer_badges_colour_id_foreign');
			$table->dropForeign('farmer_badges_user_id_foreign');
		});

		Schema::table('organizations', function(Blueprint $table) {
			$table->dropForeign('organizations_contact_id_foreign');
			$table->dropForeign('organizations_address_id_foreign');
			$table->dropForeign('organizations_created_by_foreign');
		});

		Schema::table('individuals', function(Blueprint $table) {
			$table->dropForeign('individuals_gender_slug_foreign');
			$table->dropForeign('individuals_created_by_foreign');
		});

		Schema::table('contacts', function(Blueprint $table) {
			$table->dropForeign('contacts_contact_type_id_foreign');
		});

		Schema::table('representatives', function(Blueprint $table) {
			$table->dropForeign('representatives_contact_id_foreign');
			$table->dropForeign('representatives_id_type_id_foreign');
		});

		Schema::table('parcel_proof_of_interest', function(Blueprint $table) {
			$table->dropForeign('parcel_proof_of_interest_parcel_id_foreign');
			$table->dropForeign('parcel_proof_of_interest_proof_of_int_id_foreign');
		});

	}
}