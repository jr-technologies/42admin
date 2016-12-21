<?php

namespace App\Listeners\Listeners\Location;

use App\Events\Events\Location\LocationCreated;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;


class AddLocationInAlgolia extends Listener implements ListenerInterface
{
   public function __construct()
    {

    }

    public function handle(LocationCreated $event)
    {
        $location = $event->location;
        $client =  algoliasearch("JC1U32GR7Y", "516c56557094406ec945522b714ab640");
        $index = $client->initIndex('location');

        $index->addObject(
            [
                'id' => $location->id,
                'city_id'  => $location->cityId,
                'location'  => $location->location,
                'lat'  => $location->lat,
                'long'  => $location->long,
                'title'  => $location->title,
                'keyword'  => $location->keyword,
                'description'  => $location->description,
                'slug'  => $location->slug,
                'index'  => $location->index,
                'createdAt'  => $location->createdAt,
                'updatedAt'  => $location->createdAt

            ],
            'myID'
        );

    }
}
