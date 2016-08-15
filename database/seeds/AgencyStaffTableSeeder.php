<?php

use Illuminate\Database\Seeder;

class AgencyStaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agency_staff')->insert([
            ['agency_id' => 1, 'user_id'=>1]
        ]);
    }
}
