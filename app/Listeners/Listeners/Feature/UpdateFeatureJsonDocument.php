<?php
/**
 * Created by PhpStorm.
 * User: WAQAS
 * Date: 5/17/2016
 * Time: 11:50 AM
 */

namespace App\Listeners\Listeners\Feature;


use App\DB\Providers\SQL\Models\AssignedFeatures;
use App\Events\Events\Feature\UpdateFeatureJson;
use App\Libs\Json\Creators\Creators\Feature\AssignFeaturesJsonCreator;
use App\Libs\Json\Creators\Creators\Feature\SectionsFeaturesJsonCreator;
use App\Listeners\Interfaces\ListenerInterface;
use App\Listeners\Listeners\Listener;
use App\Repositories\Repositories\Sql\AssignedFeaturesJsonRepository;

class UpdateFeatureJsonDocument extends Listener implements ListenerInterface
{
    public function handle(UpdateFeatureJson $event)
    {
        $assignedFeatures = new AssignedFeatures();
        $assignedFeatures->subTypeId = $event->subTypeId;
        $assignedFeatures->json = json_encode((new AssignFeaturesJsonCreator($event->subTypeId))->create());
         return (new AssignedFeaturesJsonRepository())->updateWhere(['property_sub_type_id'=>$event->subTypeId],$assignedFeatures);
    }
}