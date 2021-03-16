<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys3 extends Migration {

	public function up()
	{
		Schema::table('individual_contact', function(Blueprint $table) {
			$table->foreign('individual_id')->references('id')->on('individuals')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('contact_id')->references('id')->on('contacts')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('individual_address', function(Blueprint $table) {
			$table->foreign('ind_id')->references('id')->on('individuals')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('add_id')->references('id')->on('addresses')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('ind_add_type_id')->references('id')->on('individual_address_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('individual_ids', function(Blueprint $table) {
			$table->foreign('individual_id')->references('id')->on('individuals')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('id_type_id')->references('id')->on('identification_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('organization_reps', function(Blueprint $table) {
			$table->foreign('org_id')->references('id')->on('organizations')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('rep_id')->references('id')->on('representatives')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('application_organization', function(Blueprint $table) {
			$table->foreign('app_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('org_id')->references('id')->on('organizations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('application_individual', function(Blueprint $table) {
			$table->foreign('app_id')->references('id')->on('applications')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('ind_id')->references('id')->on('individuals')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('individual_contact', function(Blueprint $table) {
			$table->dropForeign('individual_contact_individual_id_foreign');
			$table->dropForeign('individual_contact_contact_id_foreign');
		});

		Schema::table('individual_address', function(Blueprint $table) {
			$table->dropForeign('individual_address_ind_id_foreign');
			$table->dropForeign('individual_address_add_id_foreign');
			$table->dropForeign('individual_address_ind_add_type_id_foreign');
		});

		Schema::table('individual_ids', function(Blueprint $table) {
			$table->dropForeign('individual_ids_individual_id_foreign');
			$table->dropForeign('individual_ids_id_type_id_foreign');
		});

		Schema::table('organization_reps', function(Blueprint $table) {
			$table->dropForeign('organization_reps_org_id_foreign');
			$table->dropForeign('organization_reps_rep_id_foreign');
		});

		Schema::table('application_organization', function(Blueprint $table) {
			$table->dropForeign('application_organization_app_id_foreign');
			$table->dropForeign('application_organization_org_id_foreign');
		});

		Schema::table('application_individual', function(Blueprint $table) {
			$table->dropForeign('application_individual_app_id_foreign');
			$table->dropForeign('application_individual_ind_id_foreign');
		});

	}
}