<?php

use Illuminate\Database\Seeder;

class ApplicationTableSeeder extends Seeder
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
            ['id' => '25', 'proof' => 'Letter Of Administration'],
            ['id' => '26', 'proof' => 'Letter of Authorization'],
            ['id' => '27', 'proof' => 'Letter Of Intent'],
            ['id' => '28', 'proof' => 'List of Directors'],
            ['id' => '29', 'proof' => 'Notary Public'],
            ['id' => '30', 'proof' => 'Power Of Attorney'],
            ['id' => '31', 'proof' => 'Probated Will'],
            ['id' => '32', 'proof' => 'Procesing Fee Receipt'],
            ['id' => '33', 'proof' => 'Rental Agreement'],
            ['id' => '34', 'proof' => 'Return Of Ownership'],
            ['id' => '35', 'proof' => 'Stateland Verification Form'],
            ['id' => '36', 'proof' => 'VAT Registration Certificate'],
        ]);

        // Application type values
        DB::table('application_types')->insert([
            ['id' => '1', 'application_type' => 'Category'],
            ['id' => '2', 'application_type' => 'Owner'],
            ['id' => '3', 'application_type' => 'Tenant'],
            ['id' => '4', 'application_type' => 'Renter'],
            ['id' => '5', 'application_type' => 'Permission To Use'],
            ['id' => '6', 'application_type' => 'Joint Tenancy'],
            ['id' => '7', 'application_type' => 'Leased Agreement'],
            ['id' => '8', 'application_type' => 'Leased Private Land'],
            ['id' => '9', 'application_type' => 'Land Owner Deceased Claimant'],
            ['id' => '10', 'application_type' => 'Expired SAL'],
            ['id' => '11', 'application_type' => 'Expired PTA'],
            ['id' => '12', 'application_type' => 'Transfers'],
            ['id' => '13', 'application_type' => 'Occupiers'],
            ['id' => '14', 'application_type' => 'Change of Tenant (Claimant of Deceased)'],
            ['id' => '15', 'application_type' => 'Organization Renting Private Land'],
        ]);

        // Application type values
        DB::table('land_types')->insert([
            ['id' => '1', 'land_type' => 'Category'],
            ['id' => '2', 'land_type' => 'Private Land'],
            ['id' => '3', 'land_type' => 'State Land'],
            ['id' => '4', 'land_type' => 'Caroni Two Acres Parcel'],
            ['id' => '5', 'land_type' => 'Caroni Tenant Farmer'],
            ['id' => '6', 'land_type' => 'Organization on Private Land'],
            ['id' => '7', 'land_type' => 'Organization on State Land'],
        ]);

        // Badge colours values
        DB::table('badge_colours')->insert([
            ['id' => '1', 'badge_colour' => 'Green'],
            ['id' => '2', 'badge_colour' => 'Cream'],
        ]);
    }
}
