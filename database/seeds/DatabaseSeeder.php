<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // all lookup table values
        $this->call(DataTableSeeder::class);
        $this->call(CountyTableSeeder::class);
        $this->call(AppDataTableSeeder::class);
        $this->call(ShortlistDataTableSeeder::class);

        // sample users for testing
        $this->call(UserTableSeeder::class);
    }
}
