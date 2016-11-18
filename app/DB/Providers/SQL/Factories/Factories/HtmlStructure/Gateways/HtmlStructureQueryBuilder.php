<?php
namespace App\DB\Providers\SQL\Factories\Factories\HtmlStructure\Gateways;
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 10:07 AM
 */
use App\DB\Providers\SQL\Factories\Factories\AgencyLocation\AgencyLocationFactory;
use App\DB\Providers\SQL\Factories\Factories\City\CityFactory;
use App\DB\Providers\SQL\Factories\Helpers\QueryBuilder;
use Illuminate\Support\Facades\DB;
class HtmlStructureQueryBuilder extends QueryBuilder
{
    public function __Construct()
    {
        $this->table = 'html_structures';
    }
}