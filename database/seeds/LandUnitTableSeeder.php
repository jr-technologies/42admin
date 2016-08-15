<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/14/2016
 * Time: 4:53 PM
 */

class LandUnitTableSeeder extends Seeder
{
 public function run()
 {
     DB::table('land_units')->insert([
         ['unit'=>'Marla'],
         ['unit'=>'Kanal'],
         ['unit'=>'square feet'],
         ['unit'=>'square yard'],
         ['unit'=>'square meter'],
     ]);
 }
}