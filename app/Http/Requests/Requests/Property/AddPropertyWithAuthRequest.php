<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Features\Feature;
use App\DB\Providers\SQL\Models\Features\PropertyFeatureValue;
use App\DB\Providers\SQL\Models\Property;
use App\DB\Providers\SQL\Models\PropertyDocument;
use App\DB\Providers\SQL\Models\User;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\CityValidators\AddCityValidator;
use App\Http\Validators\Validators\PropertyValidators\AddPropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\AddPropertyWithAuthValidator;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Repositories\Repositories\Sql\FeaturesRepository;
use App\Transformers\Request\City\AddCityTransformer;
use App\Transformers\Request\Property\AddPropertyTransformer;
use App\Transformers\Request\Property\AddPropertyWithAuthTransformer;

class AddPropertyWithAuthRequest extends Request implements RequestInterface{

    public $validator = null;
    private $features = null;
    private $statusSeeder = null;
    public function __construct(){
        parent::__construct(new AddPropertyWithAuthTransformer($this->getOriginalRequest()));
        $this->validator = new AddPropertyWithAuthValidator($this);
        $this->features = (new FeaturesRepoProvider())->repo();
        $this->statusSeeder = new \PropertyStatusTableSeeder();
    }

    public function isMember()
    {
        return ($this->get('memberType') == 1)?true:false;
    }

    public function getPropertyModel(User $user)
    {
        $property = new Property();
        $property->purposeId = $this->get('purposeId');
        $property->subTypeId =  $this->get('subTypeId');
        $property->blockId =  $this->get('blockId');
        $property->title =  $this->get('title');
        $property->description =  $this->get('description');
        $property->price =  $this->get('price');
        $property->landArea =  $this->get('landArea');
        $property->landUnitId =  $this->get('landUnitId');
        $property->statusId = $this->statusSeeder->getPendingStatusId();
        $property->totalViews = rand(0,170);
        $property->contactPerson =  $user->fName." ".$user->lName;
        $property->phone =  $user->phone;
        $property->mobile =  $user->mobile;
        $property->email =  $user->email;
        $property->fax =  $user->fax;
        $property->ownerId = $user->id;
        $property->isVerified = 0;
        $property->createdBy = $user->id;
        $property->createdAt = date('Y-m-d h:i:s');
        $property->updatedAt = date('Y-m-d h:i:s');

        return $property;
    }

    public function getFeaturesValues($propertyId)
    {
        $submittedFeatures = $this->getSubmittedPropertyFeatures();
        $featureValues = [];
        foreach($submittedFeatures as $feature /* @var $feature Feature */)
        {
            $featureValue = new PropertyFeatureValue();
            $featureValue->propertyId = $propertyId;
            $featureValue->propertyFeatureId = $feature->id;
            $featureValue->value = $this->getFeature($feature->inputName);
            $featureValue->updatedAt = date('Y-m-d h:i:s');
            $featureValues[] = $featureValue;
        }
        return $featureValues;
    }

    public function getSubmittedPropertyFeatures()
    {
        $features = $this->features->getBySubType($this->get('subTypeId'));
        $finalFeatures = [];
        foreach($features as $feature /* @var $feature Feature */)
        {
            if($this->getFeature($feature->inputName) != null)
                $finalFeatures[] = $feature;
        }
        return $finalFeatures;
    }

    public function getFiles()
    {
        $files = [];
        foreach($this->get('files') as $key => $file)
        {
            if($file['file'] != "null")
                $files[$key] = $file;
        }
        return $files;
    }
    public function getPropertyDocuments($propertyId = null)
    {
        $documents = [];

        $document = new PropertyDocument();
        $document->propertyId = $propertyId;
        $document->path = 'its a path';
        $document->title = 'bedrooms';

        $documents[] = $document;

        return $documents;
    }

    public function getUserModel()
    {
        $user = new User();
        $user->fName = $this->get('newMemberDetails')['fName'];
        $user->lName = $this->get('newMemberDetails')['lName'];
        $user->email = $this->get('newMemberDetails')['email'];
        $user->password = bcrypt($this->get('newMemberDetails')['password']);
        $user->mobile = $this->get('newMemberDetails')['cell'];
        $user->countryId = 1;
        $user->membershipPlanId = 1;
        $user->trustedAgent = 1; /* its temporary. */
        return $user;
    }

    public function getFeature($featureName)
    {
        $features = $this->get('features');
        return (isset($features[$featureName])) ? $features[$featureName] : null;
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    /**
     * @return City::class
     * */
} 