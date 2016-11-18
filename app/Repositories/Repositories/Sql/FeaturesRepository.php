<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Feature\FeatureFactory;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\Events\Events\Feature\UpdateFeatureJson;
use App\Repositories\Interfaces\Repositories\FeaturesRepoInterface;
use App\Repositories\Providers\Providers\PropertySubTypeAssignedFeatureRepoProvider;
use Illuminate\Support\Facades\Event;


class FeaturesRepository extends SqlRepository implements FeaturesRepoInterface
{
    private $factory;
    public $propertySubTypeAssignFeature = null;
    public function __construct()
    {
        $this->factory = new FeatureFactory();
        $this->propertySubTypeAssignFeature = (new PropertySubTypeAssignedFeatureRepoProvider())->repo();
    }
    public function store(Feature $feature)
    {
        $featureId = $this->factory->store($feature);
        $this->propertySubTypeAssignFeature->store(['property_sub_type_id'=>$feature->subTypeId,'property_feature_id'=>$featureId]);
        return Event::fire(new UpdateFeatureJson($feature->subTypeId));
    }
    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function getBySubType($subTypeId)
    {
        return $this->factory->getBySubType($subTypeId);
    }

    public function all()
    {
        return $this->factory->all();
    }

    public function update(Feature $feature)
    {
        $this->factory->update($feature);
        return $this->factory->find($feature->id);
    }

    public function delete(Feature $feature)
    {
        return $this->factory->delete($feature);
    }

    public function allAssigned()
    {
        return $this->factory->allAssigned();
    }

    public function assignedFeaturesWithValidationRules($subTypeId)
    {
        return $this->factory->assignedFeaturesWithValidationRules($subTypeId);
    }

    /**
     * @param int $propertyId
     * @return array
     * Desc: below function returns all given features of a property
     *          with sections
     * */
    public function getAPropertyFeaturesWithValues($propertyId)
    {
        return $this->factory->getAPropertyFeaturesWithValues($propertyId);
    }

//    public function getBySociety($id)
//    {
//        return $this->factory->getBySociety($id);
//    }
}