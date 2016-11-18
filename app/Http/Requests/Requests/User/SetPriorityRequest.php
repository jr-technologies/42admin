<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\User;


use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Transformers\Request\User\SetPriorityTransformer;

class SetPriorityRequest extends Request implements RequestInterface{

    public $validator;
    private $users =null;
    public function __construct(){
        parent::__construct(new SetPriorityTransformer($this->getOriginalRequest()));
        $this->users = (new UsersRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return true;
    }
    public function getUserModel()
    {
        return $this->users->getById($this->get('userId'));
    }
}