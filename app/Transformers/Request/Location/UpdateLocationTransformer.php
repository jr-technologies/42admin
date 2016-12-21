<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Location;


use App\Transformers\Request\RequestTransformer;


class UpdateLocationTransformer extends RequestTransformer
{
    public function transform()
    {
        return [
            'id'=>$this->request->input('location_id'),
            'cityId'=>$this->request->input('city_id'),
            'location'=>$this->request->input('location'),
            'path'=>$this->request->file('path'),
            'lat'=>$this->request->input('lat'),
            'long'=>$this->request->input('long'),
            'title'=> $this->request->input('title'),
            'keyword' => $this->request->input('keyword'),
            'description' => $this->request->input('description'),
            'index' => $this->request->input('index'),
        ];
    }
}