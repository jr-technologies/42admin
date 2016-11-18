<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Location;


use App\Transformers\Request\RequestTransformer;


class GetLocationTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'locationId' =>$this->request->input('location_id'),
        ];
    }
}