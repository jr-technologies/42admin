<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Property;


use App\DB\Providers\SQL\Models\Property;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\PropertyValidators\ApprovePropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\deActivePropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\GetAdminPropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\GetPropertyValidator;
use App\Http\Validators\Validators\PropertyValidators\RejectPropertyValidator;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Transformers\Request\Property\ApprovePropertyTransformer;
use App\Transformers\Request\Property\deActivePropertyTransformer;
use App\Transformers\Request\Property\GetAdminPropertyTransformer;
use App\Transformers\Request\Property\GetPropertyTransformer;
use App\Transformers\Request\Property\RejectPropertyTransformer;


class DeActivePropertyRequest extends Request implements RequestInterface{

    public $validator = null;
    private $properties = null;

    public function __construct(){
        parent::__construct(new DeActivePropertyTransformer($this->getOriginalRequest()));
        $this->validator = new DeActivePropertyValidator($this);
        $this->properties = (new PropertiesRepoProvider())->repo();
    }
    /**
     * @return Property|null
     */
    public function getPropertyModel()
    {
        return $this->properties->getById($this->get('propertyId'));
    }
    public function authorize(){

        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
}