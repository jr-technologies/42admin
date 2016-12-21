<?php

namespace App\Listeners\Listeners\Property;

use App\Events\Events\Property\LocationUpdated;
use App\Events\Events\Property\PropertiesStatusChanged;
use App\Libs\Json\Creators\Creators\Property\PropertyStatusJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Providers\Providers\PropertyStatusesRepoProvider;
use App\Repositories\Repositories\Sql\PropertiesJsonRepository;

class UpdateLocationInPropertiesJson extends Listener implements ListenerInterface
{
    private $propertiesJsonRepository = null;
    public function __construct()
    {
        $this->propertiesJsonRepository = new PropertiesJsonRepository();

    }

    /**
     * @param LocationUpdated $event
     */
    public function handle(LocationUpdated $event)
    {

        $location = $event->location;
        $properties = $this->propertiesJsonRepository->gerPropertiesByLocation($location->id);
        foreach($properties as $property)
        {
            $property->location->id = $location->id;
            $property->location->location = $location->location;
            $property->location->cityId = $location->cityId;
            $property->location->slug = preg_replace('/\s+/', '-',$location->location.'_'.$location->id);
            $this->propertiesJsonRepository->update($property);
        }

    }
}