<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys1 extends Migration {

	public function up()
	{
		Schema::table('applications', function(Blueprint $table) {
			$table->foreign('registration_id')->references('id')->on('registration_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('created_by')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('status_id')->references('id')->on('status')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('app_type_id')->references('id')->on('application_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('users', function(Blueprint $table) {
			$table->foreign('role')->references('slug')->on('roles')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('application_enterprise', function(Blueprint $table) {
			$table->foreign('enterprise_id')->references('id')->on('enterprises')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('application_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parcels', function(Blueprint $table) {
			$table->foreign('land_id')->references('id')->on('land')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('land_type_id')->references('id')->on('land_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('tenure_code_id')->references('id')->on('tenure_codes')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('application_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('addresses', function(Blueprint $table) {
			$table->foreign('lot_type_id')->references('id')->on('address_lot_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parcel_types_of_produce', function(Blueprint $table) {
			$table->foreign('parcel_id')->references('id')->on('parcels')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('parcel_type_id')->references('id')->on('parcel_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('officer_application_verifications', function(Blueprint $table) {
			$table->foreign('application_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');			
			$table->foreign('verification_id')->references('id')->on('status')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('applications', function(Blueprint $table) {
			$table->dropForeign('applications_registration_id_foreign');
			$table->dropForeign('applications_created_by_foreign');
			$table->dropForeign('applications_status_id_foreign');
			$table->dropForeign('applications_app_type_id_foreign');
		});

		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_role_foreign');
			$table->dropForeign('users_district_id_foreign');
		});

		Schema::table('application_enterprise', function(Blueprint $table) {
			$table->dropForeign('application_enterprise_enterprise_id_foreign');
			$table->dropForeign('application_enterprise_application_id_foreign');
		});

		Schema::table('parcels', function(Blueprint $table) {
			$table->dropForeign('parcels_land_id_foreign');
			$table->dropForeign('parcels_land_type_id_foreign');
			$table->dropForeign('parcels_tenure_code_id_foreign');
			$table->dropForeign('parcels_application_id_foreign');
		});

		Schema::table('addresses', function(Blueprint $table) {
			$table->dropForeign('addresses_lot_type_id_foreign');
			$table->dropForeign('addresses_district_id_foreign');
		});

		Schema::table('parcel_types_of_produce', function(Blueprint $table) {
			$table->dropForeign('parcel_types_of_produce_parcel_id_foreign');
			$table->dropForeign('parcel_types_of_produce_parcel_type_id_foreign');
		});

		Schema::table('officer_application_verifications', function(Blueprint $table) {
			$table->dropForeign('officer_application_verifications_application_id_foreign');
			$table->dropForeign('officer_application_verifications_verification_id_foreign');
			$table->dropForeign('officer_application_verifications_user_id_foreign');
		});
	}
}