<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */


namespace App\DB\Providers\SQL\Factories\Factories\HtmlStructure;

use App\DB\Providers\SQL\Factories\Factories\HtmlStructure\Gateways\HtmlStructureQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\HtmlStructure;
use App\DB\Providers\SQL\Models\Location;

class HtmlStructureFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public function __construct()
    {
        $this->htmlStructure = new HtmlStructure();
        $this->tableGateway = new HtmlStructureQueryBuilder();
    }

    /**
     * @param $id
     * @return Location|null
     */
    function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    function all()
    {
       return $this->mapCollection($this->tableGateway->all());
    }


    public function delete(HtmlStructure $htmlStructure)
    {
        return $this->tableGateway->delete($htmlStructure->id);
    }

    private function mapPropertyTypeOnTable(HtmlStructure $htmlStructure)
    {
        return [
            'name'=>$this->htmlStructure->name,
            'updated_at' => $this->htmlStructure->updatedAt,
        ];
    }
    public function updateWhere(array $where, array $data)
    {
        return $this->tableGateway->updateWhere($where, $data);
    }

    /**
     * @param $result
     * @return Location
     */
    function map($result)
    {
        $location = clone($this->htmlStructure);
        $location->id=$result->id;
        $location->name = $result->structure;
        $location->createdAt = $result->created_at;
        $location->updatedAt = $result->updated_at;
        return $location;
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