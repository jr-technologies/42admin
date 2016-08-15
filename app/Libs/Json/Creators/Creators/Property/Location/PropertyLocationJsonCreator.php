<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/25/2016
 * Time: 11:39 AM
 */

namespace App\Libs\Json\Creators\Creators\Property\Location;

use App\DB\Providers\SQL\Models\Property\PropertyCompleteLocation;
use App\Libs\Json\Creators\Creators\JsonCreator;
use App\Libs\Json\Creators\Interfaces\JsonCreatorInterface;
use App\Libs\Json\Prototypes\Prototypes\Property\Location\PropertyLocationJsonPrototype;

class PropertyLocationJsonCreator extends JsonCreator implements JsonCreatorInterface
{
    public function __construct(PropertyCompleteLocation $location = null)
    {
        $this->model = $location;
        $this->prototype = new PropertyLocationJsonPrototype();
    }

    public function create()
    {
        $this->prototype->country = $this->getCountry();
        $this->prototype->city = $this->getCity();
        $this->prototype->society = $this->getSociety();
        $this->prototype->block = $this->getBlock();
        return $this->prototype;
    }

    private function getBlock()
    {
        return (new PropertyBlockJsonCreator($this->model->block))->create();
    }
    private function getSociety()
    {
        return (new PropertySocietyJsonCreator($this->model->society))->create();
    }
    private function getCity()
    {
        return (new PropertyCityJsonCreator($this->model->city))->create();
    }
    private function getCountry()
    {
        return (new PropertyCountryJsonCreator($this->model->country))->create();
    }
}