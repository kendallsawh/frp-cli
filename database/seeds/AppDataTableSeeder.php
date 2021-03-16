<?php

use Illuminate\Database\Seeder;

class AppDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Proof interest lands utilized code values
        DB::table('proof_of_interest_codes')->insert([
            ['id' => '1', 'proof' => 'Affidavit'],
			['id' => '2', 'proof' => 'Allocation Letter'],
			['id' => '3', 'proof' => 'Annual Agrement'],
			['id' => '4', 'proof' => 'Article of Associations'],
			['id' => '5', 'proof' => 'Certificate of Incorporation'],
			['id' => '6', 'proof' => 'Certified Copy of Tractor'],
			['id' => '7', 'proof' => 'Consent to Absolute Assignment'],
			['id' => '8', 'proof' => 'Current Land Tax Receipt'],
			['id' => '9', 'proof' => 'Current PTA'],
			['id' => '10', 'proof' => 'Current Rent Receipt'],
			['id' => '11', 'proof' => 'Current SAL'],
			['id' => '12', 'proof' => 'Death Certificate'],
			['id' => '13', 'proof' => 'Deed of Assent'],
			['id' => '14', 'proof' => 'Deed/Certificate Of Title'],
			['id' => '15', 'proof' => 'Expired Lease; PTA'],
			['id' => '16', 'proof' => 'Expired PTA'],
			['id' => '17', 'proof' => 'Expired Rent Receipt'],
			['id' => '18', 'proof' => 'Expired SAL'],
			['id' => '19', 'proof' => 'Farmer Recommendation Letter'],
			['id' => '20', 'proof' => 'Inventory'],
			['id' => '21', 'proof' => 'Land Assesment Form'],
			['id' => '22', 'proof' => 'Lease Document'],
			['id' => '23', 'proof' => 'Letter Of Acknowledgement'],
			['id' => '24', 'proof' => 'Letter Of Administration'],
			['id' => '25', 'proof' => 'Letter of Authorization'],
			['id' => '26', 'proof' => 'Letter Of Intent'],
			['id' => '27', 'proof' => 'List of Directors'],
			['id' => '28', 'proof' => 'Notary Public'],
			['id' => '29', 'proof' => 'Power Of Attorney'],
			['id' => '30', 'proof' => 'Probated Will'],
			['id' => '31', 'proof' => 'Procesing Fee Receipt'],
			['id' => '32', 'proof' => 'Rental Agreement'],
			['id' => '33', 'proof' => 'Return Of Ownership'],
			['id' => '34', 'proof' => 'Stateland Verification Form'],
			['id' => '35', 'proof' => 'VAT Registration Certificate'],
        ]);

        // Application type values
        DB::table('application_types')->insert([
            ['id' => '1', 'application_type' => 'Owner'],
			['id' => '2', 'application_type' => 'Tenant'],
			['id' => '3', 'application_type' => 'Renter'],
			['id' => '4', 'application_type' => 'Permission To Use'],
			['id' => '5', 'application_type' => 'Joint Tenancy'],
			['id' => '6', 'application_type' => 'Leased Agreement'],
			['id' => '7', 'application_type' => 'Leased Private Land'],
			['id' => '8', 'application_type' => 'Land Owner Deceased Claimant'],
			['id' => '9', 'application_type' => 'Expired SAL'],
			['id' => '10', 'application_type' => 'Expired PTA'],
			['id' => '11', 'application_type' => 'Transfers'],
			['id' => '12', 'application_type' => 'Occupiers'],
			['id' => '13', 'application_type' => 'Change of Tenant (Claimant of Deceased)'],
			['id' => '14', 'application_type' => 'Organization Renting Private Land'],
			['id' => '15', 'application_type' => 'Organization Owner'],
        ]);

        // Application type values
        DB::table('land_types')->insert([
            ['id' => '1', 'land_type' => 'Private Land'],
			['id' => '2', 'land_type' => 'State Land'],
			['id' => '3', 'land_type' => 'Caroni Two Acres Parcel'],
			['id' => '4', 'land_type' => 'Caroni Tenant Farmer'],
			['id' => '5', 'land_type' => 'Organization on Private Land'],
			['id' => '6', 'land_type' => 'Organization on State Land'],
        ]);

        // Badge colours values
        DB::table('badge_colours')->insert([
            ['id' => '1', 'badge_colour' => 'Green'],
            ['id' => '2', 'badge_colour' => 'Cream'],
        ]);

        // 
        DB::table('tenure_proof_relation')->insert([
			['app_id' => '2', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '10'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '10'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '10'],
			['app_id' => '9', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '18'],
			['app_id' => '9', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '10'],
			['app_id' => '9', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '34'],
			['app_id' => '9', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '18'],
			['app_id' => '9', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '10'],
			['app_id' => '9', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '34'],
			['app_id' => '10', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '16'],
			['app_id' => '10', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '10'],
			['app_id' => '10', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '34'],
			['app_id' => '10', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '16'],
			['app_id' => '10', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '10'],
			['app_id' => '10', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '34'],
			['app_id' => '11', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '11'],
			['app_id' => '11', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '10'],
			['app_id' => '11', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '34'],
			['app_id' => '11', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '23'],
			['app_id' => '12', 'land_id' => '2','tenure_id' => '3', 'proof_id' => '34'],
			['app_id' => '2', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '31'],
			['app_id' => '13', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '12'],
			['app_id' => '11', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '23'],
			['app_id' => '3', 'land_id' => '4','tenure_id' => '2', 'proof_id' => '10'],
			['app_id' => '1', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '8'],
			['app_id' => '1', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '14'],
			['app_id' => '4', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '8'],
			['app_id' => '4', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '14'],
			['app_id' => '3', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '8'],
			['app_id' => '3', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '10'],
			['app_id' => '3', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '14'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '8'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '14'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '8'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '14'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '8'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '14'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '8'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '14'],
			['app_id' => '6', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '8'],
			['app_id' => '6', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '14'],
			['app_id' => '6', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '22'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '8'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '12'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '14'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '8'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '12'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '14'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '8'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '12'],
			['app_id' => '8', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '14'],
        ]);

        // 
        DB::table('tenure_proof_rel_opt')->insert([
            ['app_id' => '2', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '11','conditional'=>'0'],
			['app_id' => '2', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '3','conditional'=>'0'],
			['app_id' => '2', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '9','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '3','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '8','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '9','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '2', 'proof_id' => '11','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '3','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '8','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '9','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '2','tenure_id' => '1', 'proof_id' => '11','conditional'=>'0'],
			['app_id' => '2', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '2','conditional'=>'0'],
			['app_id' => '2', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '11','conditional'=>'0'],
			['app_id' => '2', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '26','conditional'=>'0'],
			['app_id' => '13', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '24','conditional'=>'0'],
			['app_id' => '13', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '30','conditional'=>'0'],
			['app_id' => '13', 'land_id' => '3','tenure_id' => '2', 'proof_id' => '13','conditional'=>'0'],
			['app_id' => '4', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '1','conditional'=>'0'],
			['app_id' => '4', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '28','conditional'=>'0'],
			['app_id' => '4', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '21','conditional'=>'1'],
			['app_id' => '4', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '33','conditional'=>'1'],
			['app_id' => '3', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '1','conditional'=>'0'],
			['app_id' => '3', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '28','conditional'=>'0'],
			['app_id' => '3', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '21','conditional'=>'1'],
			['app_id' => '3', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '33','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '1','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '28','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '21','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '5', 'proof_id' => '33','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '1','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '28','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '21','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '33','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '1','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '28','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '21','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '7', 'proof_id' => '33','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '1','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '28','conditional'=>'0'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '21','conditional'=>'1'],
			['app_id' => '5', 'land_id' => '1','tenure_id' => '8', 'proof_id' => '33','conditional'=>'1'],
			['app_id' => '6', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '21','conditional'=>'1'],
			['app_id' => '6', 'land_id' => '1','tenure_id' => '6', 'proof_id' => '33','conditional'=>'1'],
        ]);
    }
}
