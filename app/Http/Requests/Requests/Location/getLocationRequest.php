<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Location;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LocationValidators\GetLocationsValidator;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Transformers\Request\Location\GetLocationTransformer;

class GetLocationRequest extends Request implements RequestInterface{

    public $validator = null;
    private $location = null;
    public function __construct(){
        parent::__construct(new GetLocationTransformer($this->getOriginalRequest()));
        $this->validator = new GetLocationsValidator($this);
        $this->location = (new LocationsRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

    public function getLocationModel()
    {
        return $this->location->getById($this->get('id'));
    }

} 