<?php
namespace App\Transformers\Request\Location;

use App\Transformers\Request\RequestTransformer;

class GetLocationsByCityTransformer extends RequestTransformer
{
 public function transform()
  {
     return [
         'cityId'=>$this->request->input('city_id'),
         'start'=>$this->request->input('start'),
         'limit'=>$this->request->input('limit'),
         'page'=>$this->request->input('page'),
     ];
  }
}