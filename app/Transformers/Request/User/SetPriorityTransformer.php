<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:54 PM
 */

namespace App\Transformers\Request\User;


use App\Transformers\Request\RequestTransformer;

class SetPriorityTransformer extends RequestTransformer{

    public function transform(){
        return [
            'userId' => $this->request->input('agent_id'),
            'priority' => $this->request->input('priority')
        ];
    }
} 