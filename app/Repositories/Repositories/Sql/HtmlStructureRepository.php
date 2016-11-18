<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;



use App\DB\Providers\SQL\Factories\Factories\HtmlStructure\HtmlStructureFactory;
use App\Repositories\Interfaces\Repositories\HtmlStructureRepoInterface;
use App\DB\Providers\SQL\Models\Features\Feature;


class HtmlStructureRepository extends SqlRepository implements HtmlStructureRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new HtmlStructureFactory();
    }
    public function all()
    {
        return $this->factory->all();
    }

}