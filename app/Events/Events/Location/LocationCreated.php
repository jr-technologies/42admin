<?php

namespace App\Events\Events\Location;

use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\Location;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class LocationCreated extends Event
{
    use SerializesModels;


    public $location = null;

    /**
     * @param Location $location
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
