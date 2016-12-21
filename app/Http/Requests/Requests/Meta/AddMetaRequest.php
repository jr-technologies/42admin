<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Meta;


use App\DB\Providers\SQL\Models\City;
use App\DB\Providers\SQL\Models\Meta;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\CityValidators\AddCityValidator;
use App\Http\Validators\Validators\MetaValidators\AddMetaValidator;
use App\Transformers\Request\City\AddCityTransformer;
use App\Transformers\Request\Meta\AddMetaTransformer;

class AddMetaRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddMetaTransformer($this->getOriginalRequest()));
        $this->validator = new AddMetaValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function getMetaModel()
    {
        $meta = new Meta();
        $meta->page = $this->get('page');
        $meta->title = $this->get('title');
        $meta->keyword = $this->get('keyword');
        $meta->description = $this->get('description');
        return $meta;
    }

}