<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\City\AddCityRequest;
use App\Http\Requests\Requests\City\DeleteCityRequest;
use App\Http\Requests\Requests\City\GetAllCitiesRequest;
use App\Http\Requests\Requests\City\GetCitiesByCountryRequest;
use App\Http\Requests\Requests\City\GetCitiesBySocietyRequest;
use App\Http\Requests\Requests\City\UpdateCityRequest;
use App\Http\Requests\Requests\Feature\AddFeatureRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\CountriesRepoProvider;
use App\Repositories\Providers\Providers\FeaturesRepoProvider;
use App\Repositories\Providers\Providers\HtmlStructureRepoProvider;
use App\Repositories\Providers\Providers\PropertySubTypesRepoProvider;
use App\Repositories\Providers\Providers\PropertyTypesRepoProvider;
use App\Repositories\Repositories\Sql\FeatureSectionRepository;
use App\Repositories\Repositories\Sql\PropertyTypeRepository;
use App\Transformers\Response\CityTransformer;

class FeaturesController extends Controller
{
    public $response = null;
    public $subTypes =null;
    public $htmlStructure = null;
    public $feature =null;
    public function __construct
    (
        WebResponse $response,CityTransformer $countryTransformer,
        CitiesRepoProvider $citiesRepository
    )
    {
        $this->cities =  $citiesRepository->repo();
        $this->response = $response;
        $this->htmlStructure = (new HtmlStructureRepoProvider())->repo();
        $this->subTypes = (new PropertySubTypesRepoProvider())->repo();
        $this->feature = (new FeaturesRepoProvider())->repo();
        $this->featureSection = new FeatureSectionRepository();

    }
    public function index()
    {
        return $this->response->setView('features.add_features')->respond(['data'=>[
            'subTypes'=>$this->subTypes->all(),
            'htmlStructures'=>$this->htmlStructure->all(),
            'featureSection'=>$this->featureSection->all(),
            'linkStatus'=>'features'
        ]]);
    }
    public function store(AddFeatureRequest $request)
    {
        $this->feature->store($request->GetFeatureModel());
        return redirect()->back();
    }
}
