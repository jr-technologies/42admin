<?php
/**
 * Created by waqas.
 * User: waqas
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Society;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\SocietyValidators\GetAllSocietiesForFilesValidator;
use App\Http\Validators\Validators\SocietyValidators\GetAllSocietiesForMapsValidator;
use App\Http\Validators\Validators\SocietyValidators\GetAllSocietiesValidator;
use App\Transformers\Request\Society\GetAllSocietiesForFilesTransformer;
use App\Transformers\Request\Society\GetAllSocietiesForMapsTransformer;
use App\Transformers\Request\Society\GetAllSocietiesTransformer;

class GetAllSocietiesForFilesRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new GetAllSocietiesForFilesTransformer($this->getOriginalRequest()));
        $this->validator =  new GetAllSocietiesForFilesValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 