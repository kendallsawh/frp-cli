<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys7 extends Migration {

	public function up()
	{
		Schema::table('farmer_badge_logs', function(Blueprint $table) {
			$table->foreign('badge_id')->references('id')->on('farmer_badges')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('colour_id')->references('id')->on('badge_colours')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('issued_by')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('farmer_badge_replacements', function(Blueprint $table) {
			$table->foreign('badge_id')->references('id')->on('farmer_badges')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('replacement_type_id')->references('id')->on('replacement_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('issued_by')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
						
		});

		Schema::table('app_land_tenure', function(Blueprint $table) {
			$table->foreign('app_id')->references('id')->on('application_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('land_id')->references('id')->on('land_types')
						->onDelete('cascade')
						->onUpdate('cascade');
			$table->foreign('tenure_id')->references('id')->on('tenure_codes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('farmer_badge_logs', function(Blueprint $table) {
			$table->dropForeign('farmer_badge_logs_badge_id_foreign');
			$table->dropForeign('farmer_badge_logs_colour_id_foreign');
			$table->dropForeign('farmer_badge_logs_issued_by_foreign');
		});

		Schema::table('farmer_badge_replacements', function(Blueprint $table) {
			$table->dropForeign('farmer_badge_replacements_badge_id_foreign');
			$table->dropForeign('farmer_badge_replacements_issued_by_foreign');
			$table->dropForeign('farmer_badge_replacements_replacement_type_id_foreign');
		});

		Schema::table('app_land_tenure', function(Blueprint $table) {
			$table->dropForeign('app_land_tenure_app_id_foreign');
			$table->dropForeign('app_land_tenure_land_id_foreign');
			$table->dropForeign('app_land_tenure_tenure_id_foreign');
		});

	}
}