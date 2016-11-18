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
use App\Http\Validators\Validators\LocationValidators\UpdateLocationValidator;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Transformers\Request\Location\AddLocationTransformer;
use App\Transformers\Request\Location\UpdateLocationTransformer;

class UpdateLocationRequest extends Request implements RequestInterface{

    public $validator = null;
    private $locaiton= "";
    public function __construct(){
        parent::__construct(new UpdateLocationTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateLocationValidator($this);
        $this->location = (new LocationsRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }


    public function getLocationModel()
    {
        $location = $this->location->getById($this->get('id'));
        $location->id = $this->get('id');
        $location->cityId = $this->get('cityId');
        $location->location = $this->get('location');
        $location->lat = $this->get('lat');
        $location->long = $this->get('long');
        if($this->get('path') !="" && $this->get('path') !=null)
            $location->path = $this->getLocationPath();

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