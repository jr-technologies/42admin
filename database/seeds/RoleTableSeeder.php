<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['role' => 'Owner/Investor'],
            ['role' => 'tenant'],
            ['role' => 'agent/broker'],
            ['role' => 'appraiser'],
            ['role' => 'architect'],
            ['role' => 'builder'],
            ['role' => 'corporate investor'],
            ['role' => 'developer'],
            ['role' => 'listing administrator'],
            ['role' => 'mortgage broker'],
            ['role' => 'property/asset manager'],
            ['role' => 'researcher']
        ]);
    }
}
