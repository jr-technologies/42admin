<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Meta;


use App\Transformers\Request\RequestTransformer;


class DeleteMetaTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id' =>$this->request->input('meta_id'),
        ];
    }
}