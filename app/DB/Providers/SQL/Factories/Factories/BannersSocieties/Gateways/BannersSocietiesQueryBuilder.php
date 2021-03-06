<?php
namespace App\DB\Providers\SQL\Factories\Factories\BannersSocieties\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class BannersSocietiesQueryBuilder extends QueryBuilder
{

    public function __Construct()
    {
        $this->table = 'banners_targeted_Locations';
    }
    public function getByBanner($bannerId)
    {
       return DB::table($this->table)
            ->select($this->table.'.location_id')
            ->where($this->table.'.banner_id','=',$bannerId)
            ->get();
    }
}