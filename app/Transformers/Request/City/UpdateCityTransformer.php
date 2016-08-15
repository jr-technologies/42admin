<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\City;


use App\Transformers\Request\RequestTransformer;


class UpdateCityTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id' =>$this->request->input('city_id'),
            'name'=>$this->request->input('city_name'),
            'country_id' => $this->request->input('country_id')
        ];
    }
}