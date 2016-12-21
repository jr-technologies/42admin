<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Meta;


use App\Transformers\Request\RequestTransformer;


class AddMetaTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'page'=>$this->request->input('page'),
            'keyword' => $this->request->input('keyword'),
            'title' => $this->request->input('title'),
            'description' => $this->request->input('description')
        ];
    }
}