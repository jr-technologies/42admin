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
use App\Http\Validators\Validators\CityValidators\UpdateCityValidator;
use App\Http\Validators\Validators\MetaValidators\UpdateMetaValidator;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Transformers\Request\City\UpdateCityTransformer;
use App\Transformers\Request\Meta\UpdateMetaTransformer;

class UpdateMetaRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new UpdateMetaTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateMetaValidator($this);

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
        $meta->id = $this->get('id');
        $meta->page = $this->get('page');
        $meta->title = $this->get('title');
        $meta->keyword = $this->get('keyword');
        $meta->description = $this->get('description');
        return $meta;
    }
} 