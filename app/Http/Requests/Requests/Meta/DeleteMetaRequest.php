<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Meta;


use App\DB\Providers\SQL\Models\City;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\CityValidators\DeleteCityValidator;
use App\Http\Validators\Validators\MetaValidators\DeleteMetaValidator;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Repositories\Sql\CitiesRepository;
use App\Transformers\Request\City\DeleteCityTransformer;
use App\Transformers\Request\Meta\DeleteMetaTransformer;

class DeleteMetaRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new DeleteMetaTransformer($this->getOriginalRequest()));
        $this->validator = new DeleteMetaValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

}