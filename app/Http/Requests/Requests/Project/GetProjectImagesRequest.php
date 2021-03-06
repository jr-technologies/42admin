<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Project;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\ProjectValidators\GetProjectImagesValidator;
use App\Transformers\Request\Project\GetProjectImagesTransformer;


class GetProjectImagesRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new GetProjectImagesTransformer($this->getOriginalRequest()));
        $this->validator = new GetProjectImagesValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }

} 