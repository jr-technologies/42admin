<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;



use App\DB\Providers\SQL\Factories\Factories\PropertySubTypeAssignedFeature\PropertySubTypeAssignedFeatureFactory;
use App\Repositories\Interfaces\Repositories\HtmlStructureRepoInterface;


class PropertySubTypeAssignedFeature extends SqlRepository implements HtmlStructureRepoInterface
{
    private $factory;
    public function __construct()
    {
         $this->factory = new PropertySubTypeAssignedFeatureFactory();
    }
    public function all()
    {
        return $this->factory->all();
    }
    public function store(array $propertySubTypeAssignFeature)
    {
        return $this->factory->store($propertySubTypeAssignFeature);
    }

}