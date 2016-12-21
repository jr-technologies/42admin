<?php

namespace App\Events\Events\Property;

use App\DB\Providers\SQL\Models\Agency;
use App\DB\Providers\SQL\Models\Property;
use App\Events\Events\Event;
use Illuminate\Queue\SerializesModels;

class LocationUpdated extends Event
{
    use SerializesModels;

    public $location =null;


    public function __construct($location)
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