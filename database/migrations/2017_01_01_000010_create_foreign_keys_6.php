<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys6 extends Migration {

	public function up()
	{
		Schema::table('service_providers', function(Blueprint $table) {
			$table->foreign('status_id')->references('id')->on('status')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('created_by')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('service_provider_individual', function(Blueprint $table) {
			$table->foreign('provider_id')->references('id')->on('service_providers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('ind_id')->references('id')->on('individuals')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('service_provider_organization', function(Blueprint $table) {
			$table->foreign('provider_id')->references('id')->on('service_providers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('org_id')->references('id')->on('organizations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('recommendations', function(Blueprint $table) {
			$table->foreign('farmer_id')->references('id')->on('farmers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('provider_id')->references('id')->on('service_providers')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('land_id')->references('id')->on('land')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('land', function(Blueprint $table) {
			$table->foreign('address_id')->references('id')->on('addresses')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('area_type_id')->references('id')->on('area_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('tenure_proof_relation', function(Blueprint $table) {
			$table->foreign('app_id')->references('id')->on('application_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('land_id')->references('id')->on('land_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('tenure_id')->references('id')->on('tenure_codes')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('proof_id')->references('id')->on('proof_of_interest_codes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('tenure_proof_rel_opt', function(Blueprint $table) {
			$table->foreign('app_id')->references('id')->on('application_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('land_id')->references('id')->on('land_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('tenure_id')->references('id')->on('tenure_codes')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('proof_id')->references('id')->on('proof_of_interest_codes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('service_providers', function(Blueprint $table) {
			$table->dropForeign('service_providers_status_id_foreign');
			$table->dropForeign('service_providers_created_by_foreign');
		});

		Schema::table('service_provider_individual', function(Blueprint $table) {
			$table->dropForeign('service_provider_individual_provider_id_foreign');
			$table->dropForeign('service_provider_individual_ind_id_foreign');
		});

		Schema::table('service_provider_organization', function(Blueprint $table) {
			$table->dropForeign('service_provider_organization_provider_id_foreign');
			$table->dropForeign('service_provider_organization_org_id_foreign');
		});

		Schema::table('recommendations', function(Blueprint $table) {
			$table->dropForeign('recommendations_farmer_id_foreign');
			$table->dropForeign('recommendations_provider_id_foreign');
			$table->dropForeign('recommendations_land_id_foreign');
		});

		Schema::table('land', function(Blueprint $table) {
			$table->dropForeign('land_address_id_foreign');
			$table->dropForeign('land_area_type_id_foreign');
		});

		Schema::table('tenure_proof_relation', function(Blueprint $table) {
			$table->dropForeign('tenure_proof_relation_app_id_foreign');
			$table->dropForeign('tenure_proof_relation_land_id_foreign');
			$table->dropForeign('tenure_proof_relation_tenure_id_foreign');
			$table->dropForeign('tenure_proof_relation_proof_id_foreign');
		});

		Schema::table('tenure_proof_rel_opt', function(Blueprint $table) {
			$table->dropForeign('tenure_proof_rel_opt_app_id_foreign');
			$table->dropForeign('tenure_proof_rel_opt_land_id_foreign');
			$table->dropForeign('tenure_proof_rel_opt_tenure_id_foreign');
			$table->dropForeign('tenure_proof_rel_opt_proof_id_foreign');
		});

	}
}