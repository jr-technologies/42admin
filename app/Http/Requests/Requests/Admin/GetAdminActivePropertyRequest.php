<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Admin;


use App\DB\Providers\SQL\Models\Property;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\AdminValidators\GetAdminActivePropertiesValidator;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Transformers\Request\Admin\GetAdminActivePropertiesTransformer;


class GetAdminActivePropertyRequest extends Request implements RequestInterface{

    public $validator = null;
    private $properties = null;

    public function __construct(){
        parent::__construct(new GetAdminActivePropertiesTransformer($this->getOriginalRequest()));
        $this->validator = new GetAdminActivePropertiesValidator($this);
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