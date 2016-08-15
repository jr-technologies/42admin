<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class GetUsersTransformer extends RequestTransformer{

    public function transform(){
        return [
            'email'=>$this->request->input('email'),
            'phone'=>$this->request->input('phone'),
            'firstName'=>$this->request->input('fname'),
            'lastName'=>$this->request->input('lname'),
            'type'=>$this->request->input('type'),
            'limit'=>$this->request->input('limit')

        ];

    }
} 