<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\PropertyJson\PropertyJsonFactory;
use App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype;
use App\Libs\SearchEngines\Properties\SearchEngineProvider;
use App\Repositories\Interfaces\Repositories\PropertiesJsonRepoInterface;

class PropertiesJsonRepository extends SqlRepository implements PropertiesJsonRepoInterface
{
    private $userJsonTransformer;
    private $factory = null;
    private $cheetah = null;
    private $propertyStatus = null;
    public function __construct(){
        $this->userJsonTransformer = null;
        $this->factory = new PropertyJsonFactory();
        $this->cheetah = (new SearchEngineProvider())->cheetah();
        $this->propertyStatus =  new \PropertyStatusTableSeeder();
    }

    public function all()
    {
        return $this->factory->all();
    }
    public function gerPropertiesByLocation($locationId)
    {
        return $this->factory->gerPropertiesByLocation($locationId);
    }
    public function search(array $instructions)
    {
        return $this->factory->search($instructions);
    }
    public function getAllProperties()
    {
        return $this->factory->getAllProperties();
    }
    public function getActiveProperties($params)
    {
        $params['id'] = $this->propertyStatus->getActiveStatusId();
        return $this->factory->getActiveProperties($params);
    }
    public function getPropertiesByUser($params)
    {
        return $this->factory->getPropertiesByUser($params);
    }
    public function propertyCount()
    {
        return $this->factory->propertyCount();
    }
    public function getPendingProperties($params)
    {
        $params['id'] = $this->propertyStatus->getPendingStatusId();
        return $this->factory->getPendingProperties($params);
    }
    public function getExpiredProperties()
    {
        $params['id'] = $this->propertyStatus->getExpiredStatusId();
        return $this->factory->getExpiredProperties($params);
    }
    public function getRejectedProperties()
    {
        $params['id'] = $this->propertyStatus->getRejectedStatusId();
        return $this->factory->getRejectedProperties($params);
    }
    public function getDeletedProperties()
    {
        $params['id'] = $this->propertyStatus->getDeletedStatusId();
        return $this->factory->getDeletedProperties($params);
    }
    public function find($id)
    {
        return $this->factory->find($id);
    }
    public function getFavouriteProperties($params)
    {
        return $this->factory->getFavouriteProperties($params);
    }
    public function store(PropertyJsonPrototype $property)
    {
        return $this->factory->store($property);
    }

    public function update($property)
    {
        return $this->factory->update($property);
    }

    public function delete($id)
    {
        return $this->factory->delete($id);
    }
    public function getUserProperties($params)
    {
        return $this->factory->getUserProperties($params);
    }
    public function countSearchedUserProperties($params)
    {
        return $this->factory->countSearchedUserProperties($params);
    }
    public function getById($propertyId)
    {
        return $this->factory->getById($propertyId);
    }
    public function getByIds(array $propertyIds)
    {
        return $this->factory->getByIds($propertyIds);
    }
    public function getAgencyProperties($agencyId)
    {
        return $this->factory->getAgencyProperties($agencyId);
    }
    public function updateMultipleByIds($properties)
    {
        foreach($properties as $property)
        {
            $this->update($property);
        }
        return true;
    }
}
