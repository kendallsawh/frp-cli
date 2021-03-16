<?php

use Illuminate\Database\Seeder;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Enterprise values
        DB::table('enterprises')->insert([
            ['enterprise' => 'Agro Processing', 'slug' => 'agro_processing'],
            ['enterprise' => 'Aquaculture', 'slug' => 'aquaculture'],
            ['enterprise' => 'Beekeeping', 'slug' => 'beekeeping'],
            ['enterprise' => 'Crop Prod&#39;n, Vegetables, Food and Root Crops', 'slug' => 'crop_vege_root'],
            ['enterprise' => 'Crop Production-Tree Crops', 'slug' => 'crop_tree_crops'],
            ['enterprise' => 'Crop Prod&#39;n-Herbs, Condiments, Spices', 'slug' => 'crop_herbs'],
            ['enterprise' => 'Crop Prod&#39;n-Sugarcane', 'slug' => 'crop_sugarcane'],
            ['enterprise' => 'Crop Prod&#39;n-Rice, Pulses, Grains', 'slug' => 'crop_rice'],
            ['enterprise' => 'Crop Prod&#39;n-Nursery', 'slug' => 'crop_nursery'],
            ['enterprise' => 'Exporting', 'slug' => 'exporting'],
            ['enterprise' => 'Fishing', 'slug' => 'fishing'],
            ['enterprise' => 'Forest Trees/Agro Forestry', 'slug' => 'agro_forestry'],
            ['enterprise' => 'Horticulture', 'slug' => 'horticulture'],
            ['enterprise' => 'Livestock-Beef Cattle', 'slug' => 'livestock_beef_cattle'],
            ['enterprise' => 'Livestock-Goats/Sheet', 'slug' => 'livestock_goats'],
            ['enterprise' => 'Livestock-Wildlife', 'slug' => 'livestock_wildlife'],
            ['enterprise' => 'Livestock-Broiler', 'slug' => 'livestock_broiler'],
            ['enterprise' => 'Livestock-Egg Production', 'slug' => 'livestock_egg'],
            ['enterprise' => 'Livestock-Small Stock', 'slug' => 'livestock_small_stock'],
            ['enterprise' => 'Livestock-Milk Production', 'slug' => 'livestock_milk'],
            ['enterprise' => 'Livestock-Pig Production', 'slug' => 'livestock_pig'],
            ['enterprise' => 'Manufacturing', 'slug' => 'manufacturing'],
            ['enterprise' => 'Supply of Inputs/Services', 'slug' => 'inputs_services'],
            ['enterprise' => 'Other', 'slug' => 'other'],
        ]);

        // Address lot type values
        DB::table('address_lot_types')->insert([
            ['lot_type' => 'KM'],
            ['lot_type' => 'MM'],
            ['lot_type' => 'LP'],
            ['lot_type' => 'Lot'],
            ['lot_type' => 'House Number'],
        ]);

        // Gender values
        DB::table('genders')->insert([
            ['gender' => 'Male', 'slug' => 'M'],
            ['gender' => 'Female', 'slug' => 'F'],
        ]);

        // Role values
        DB::table('roles')->insert([
            ['role' => 'Farmer Registration Clerk', 'slug' => 'frc'],
            ['role' => 'Clerk II', 'slug' => 'c2'],
            ['role' => 'Correspondence Clerk', 'slug' => 'cc'],
            ['role' => 'District Field Officer', 'slug' => 'dfo'],
            ['role' => 'Agricultural Assistant III', 'slug' => 'aa3'],
            ['role' => 'Agricultural Officer I', 'slug' => 'ao1'],
            ['role' => 'RAN/RAS Director', 'slug' => 'director'],
            ['role' => 'System Administrator', 'slug' => 'admin'],
        ]);

        // Farmer application type values
        DB::table('registration_types')->insert([
            ['type' => 'New', 'slug' => 'new_farmer', 'icon' => 'fa-user-plus', 'tooltip' => 'Create a new farmer application here.'],
            ['type' => 'Renewal', 'slug' => 'renew_farmer', 'icon' => 'fa-refresh', 'tooltip' => 'Renew your farmer&#39;s application here.'],
            ['type' => 'Replacement', 'slug' => 'replace_id', 'icon' => 'fa-id-badge', 'tooltip' => 'Replace your damaged or lost Farmer ID here.'],
        ]);

        // Area type values
        DB::table('area_types')->insert([
            ['area_type' => 'Hectares'],
            ['area_type' => 'Acres'],
        ]);

        // Tenure code values
        DB::table('tenure_codes')->insert([
            ['tenure_code' => '01', 'tenure' => 'State Rented'],
            ['tenure_code' => '02', 'tenure' => 'State Leased'],
            ['tenure_code' => '03', 'tenure' => 'State Occupier'],
            ['tenure_code' => '04', 'tenure' => 'State Taungya'],
            ['tenure_code' => '05', 'tenure' => 'Private Rented'],
            ['tenure_code' => '06', 'tenure' => 'Private Leased'],
            ['tenure_code' => '07', 'tenure' => 'Private Owned'],
            ['tenure_code' => '08', 'tenure' => 'Permission to Use'],
        ]);

        // Parcel unit values
        DB::table('parcel_units')->insert([
            ['id' => '1', 'parcel_unit' => 'Hectares'],
            ['id' => '2', 'parcel_unit' => 'Heads'],
            ['id' => '3', 'parcel_unit' => 'Acres'],
        ]);

        // Parcel type values
        DB::table('parcel_types')->insert([
            ['parcel_type' => 'Crops(Hectares)', 'parcel_unit_id' => '1'],
            ['parcel_type' => 'Crops(Acres)', 'parcel_unit_id' => '3'],
            ['parcel_type' => 'Livestock', 'parcel_unit_id' => '2'],
            ['parcel_type' => 'Fishes', 'parcel_unit_id' => '2'],
            ['parcel_type' => 'Hives', 'parcel_unit_id' => '2'],
        ]);

        // Status values
        DB::table('status')->insert([
            ['status' => 'Pending'],
            ['status' => 'Verified(FRC)'],
            ['status' => 'Recommended(DFO)'],
            ['status' => 'Recommended(AAIII)'],
            ['status' => 'Recommended(AOI)'],
            ['status' => 'Approved'],
            ['status' => 'Denied'],
        ]);

        // Individual address type values
        DB::table('individual_address_types')->insert([
            ['ind_address_type' => 'Home'],
            ['ind_address_type' => 'Postal'],
            ['ind_address_type' => 'Both Home and Postal'],
        ]);

        // Verification enterprises values
        DB::table('verification_enterprises')->insert([
            ['enterprise' => 'Crop'],
            ['enterprise' => 'Livestock'],
            ['enterprise' => 'Mixed'],
        ]);

        // Verification enterprises values
        DB::table('contact_types')->insert([
            ['contact_type' => 'Home'],
            ['contact_type' => 'Mobile'],
            ['contact_type' => 'Work'],
            ['contact_type' => 'Emergency'],
        ]);

        // Identification values
        DB::table('identification_types')->insert([
            ['identification_type' => 'National ID'],
            ['identification_type' => 'Driver&#39;s Permit'],
            ['identification_type' => 'Passport'],
        ]);

        // Replacement values
        DB::table('replacement_types')->insert([
            ['id' => '1', 'replacement_type' => 'Lost'],
            ['id' => '2', 'replacement_type' => 'Mutilated'],
        ]);
    }
}
