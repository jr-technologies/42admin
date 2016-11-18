<?php

namespace App\DB\Providers\SQL\Factories\Factories\City;

/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
use App\DB\Providers\SQL\Factories\Factories\City\Gateways\CityQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\City;
class CityFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->model = new City();
        $this->tableGateway = new CityQueryBuilder();
    }

    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }
    public function getImportantCities()
    {
        return $this->tableGateway->getImportantCities();
    }
    public function update(City $city)
    {
        $city->updatedAt = date('Y-m-d h:i:s');
        return $this->tableGateway->update($city->id ,$this->mapCityOnTable($city));
    }
    public function store(City $city)
    {
        $city->createdAt = date('Y-m-d h:i:s');
        return $this->tableGateway->insert($this->mapCityOnTable($city));
    }
    public function delete(City $city)
    {
        return $this->tableGateway->delete($city->id);
    }
    private function mapCityOnTable(City $city)
    {
        return [
            'city' => $city->name,
            'country_id'=>$city->countryId,
            'priority'=>$city->priority,
            'path'=>$city->path,
            'created_at' => $city->updatedAt,
        ];
    }
    public function getAllCities($param)
    {
        return $this->tableGateway->getAllCities($param);
    }
    public function citesCount()
    {
        return $this->tableGateway->citesCount();
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }
    public function  getByCountry($id)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['country_id'=>$id]));
    }
    public function getBySociety($id)
    {
        return $this->map($this->tableGateway->getBySociety($id));
    }
    function map($result)
    {
        $city            = new City();
        $city->id        = $result->id;
        $city->name      = $result->city;
        $city->countryId = $result->country_id;
        $city->priority  = $result->priority;
        $city->path      = $result->path;
        $city->createdAt = $result->created_at;
        $city->updatedAt = $result->updated_at;
        return $city;
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
}