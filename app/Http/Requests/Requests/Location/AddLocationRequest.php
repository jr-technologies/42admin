<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Location;



use App\DB\Providers\SQL\Models\Location;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\LocationValidators\AddLocationValidator;
use App\Transformers\Request\Location\AddLocationTransformer;

class AddLocationRequest extends Request implements RequestInterface{

    public $validator = null;
    public function __construct(){
        parent::__construct(new AddLocationTransformer($this->getOriginalRequest()));
        $this->validator = new AddLocationValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }


    public function getLocationModel()
    {
        $location = new Location();
        $location->cityId = $this->get('cityId');
        $location->location = $this->get('location');
        $location->path = ($this->get('path') !=null)?$this->getLocationPath():"";
        $location->lat = $this->get('lat');
        $location->long = $this->get('long');
        return $location;
    }
    public function getLocationPath()
    {
        $imageLocation = $this->get('path');
        $extension = $imageLocation->getClientOriginalExtension();
        $imageName = md5($imageLocation->getClientOriginalName()) . '.' . $extension;
        $imageLocation->move(public_path() . '/assets/imgs/projects', $imageName);
        return  'assets/imgs/projects/' . $imageName;
    }
} 