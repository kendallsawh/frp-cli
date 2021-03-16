<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys4 extends Migration {

	public function up()
	{
		Schema::table('farmer_individual', function(Blueprint $table) {
			$table->foreign('farmer_id')->references('id')->on('farmers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('ind_id')->references('id')->on('individuals')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('farmer_organization', function(Blueprint $table) {
			$table->foreign('farmer_id')->references('id')->on('farmers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('org_id')->references('id')->on('organizations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('application_flags', function(Blueprint $table) {
			$table->foreign('app_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('dnq', function(Blueprint $table) {
			$table->foreign('app_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('parcel_verification', function(Blueprint $table) {
			$table->foreign('parcel_id')->references('id')->on('parcels')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('verification_ent_id')->references('id')->on('verification_enterprises')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('officer_parcel_verification', function(Blueprint $table) {
			$table->foreign('parcel_veri_id')->references('id')->on('parcel_verification')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('farmer_individual', function(Blueprint $table) {
			$table->dropForeign('farmer_individual_farmer_id_foreign');
			$table->dropForeign('farmer_individual_ind_id_foreign');
		});

		Schema::table('farmer_organization', function(Blueprint $table) {
			$table->dropForeign('farmer_organization_farmer_id_foreign');
			$table->dropForeign('farmer_organization_org_id_foreign');
		});

		Schema::table('application_flags', function(Blueprint $table) {
			$table->dropForeign('application_flags_app_id_foreign');
			$table->dropForeign('application_flags_user_id_foreign');
		});

		Schema::table('dnq', function(Blueprint $table) {
			$table->dropForeign('dnq_app_id_foreign');
			$table->dropForeign('dnq_user_id_foreign');
		});

		Schema::table('parcel_verification', function(Blueprint $table) {
			$table->dropForeign('parcel_verification_parcel_id_foreign');
			$table->dropForeign('parcel_verification_verification_ent_id_foreign');
			$table->dropForeign('parcel_verification_user_id_foreign');
		});

		Schema::table('officer_parcel_verification', function(Blueprint $table) {
			$table->dropForeign('officer_parcel_verification_parcel_veri_id_foreign');
			$table->dropForeign('officer_parcel_verification_user_id_foreign');
		});

	}
}