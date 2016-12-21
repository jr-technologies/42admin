<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:10 AM
 */
namespace App\Http\Controllers\Web\Admin;

use App\Events\Events\Location\LocationCreated;
use App\Events\Events\Property\LocationUpdated;
use App\Http\Requests\Requests\Location\AddLocationRequest;
use App\Http\Requests\Requests\Location\DeleteLocationRequest;
use App\Http\Requests\Requests\Location\GetLocationByCityRequest;
use App\Http\Requests\Requests\Location\GetLocationRequest;
use App\Http\Requests\Requests\Location\UpdateLocationRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;


class LocationsController extends Controller
{
    public $cities ;
    public $response;
    public $location;
    public function __construct(WebResponse $webResponse)
    {
        $this->location  = (new LocationsRepoProvider())->repo();
        $this->response = $webResponse;
        $this->cities = (new CitiesRepoProvider())->repo();
    }
    public function store(AddLocationRequest $request)
    {
        $location = $request->getLocationModel();
        $this->location->store($location);
        Event::fire(new LocationCreated($location));
        return redirect('location');
    }
    public function listing()
    {
        return $this->response->setView('location.location_listing')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'linkStatus'=>'locationListing'
        ]]);
    }
    public function getByCity(GetLocationByCityRequest $request)
    {
        return $this->response->setView('location.location_listing')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'cityId'=>$request->get('cityId'),
            'locations'=>$this->location->getByCity($request->all()),
            'locationCount'=>$this->location->locationCount()[0]->total_records
        ]]);
    }
    public function index()
    {
        return $this->response->setView('location.location')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'linkStatus'=>'location'
        ]]);
    }
    public function getUpdateLocationForm(GetLocationRequest $request)
    {
        return $this->response->setView('location.update_location')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'location'=>$this->location->getById($request->get('locationId'))
        ]]);
    }
    public function update(UpdateLocationRequest $request)
    {
        $location = $this->location->update($request->getLocationModel());
        Event::fire(new LocationUpdated($location));
        return $this->response->setView('location.location_listing')->respond(['data'=>[
            'cities'=>$this->cities->all(),
            'locations'=>$this->location->getByCity($request->all()),
            'locationCount'=>$this->location->locationCount()[0]->total_records
        ]]);
    }
    public function delete(DeleteLocationRequest $request)
    {
        $location = $this->location->delete($request->getLocationModel());
        return redirect()->back();
//        return $this->response->setView('location.location_listing')->respond(['data'=>[
//            'cities'=>$this->cities->all(),
//            'locations'=>$this->location->getByCity(['cityId'=>$location->cityId]),
//            'locationCount'=>$this->location->locationCount()[0]->total_records
//        ]]);
    }

}