<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\City\AddCityRequest;
use App\Http\Requests\Requests\City\DeleteCityRequest;
use App\Http\Requests\Requests\City\GetAllCitiesRequest;
use App\Http\Requests\Requests\City\GetCitiesByCountryRequest;
use App\Http\Requests\Requests\City\GetCitiesBySocietyRequest;
use App\Http\Requests\Requests\City\UpdateCityRequest;
use App\Http\Requests\Requests\Meta\AddMetaRequest;
use App\Http\Requests\Requests\Meta\DeleteMetaRequest;
use App\Http\Requests\Requests\Meta\UpdateMetaRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\CitiesRepoProvider;
use App\Repositories\Providers\Providers\CountriesRepoProvider;
use App\Repositories\Providers\Providers\MetaRepoProvider;
use App\Repositories\Repositories\Sql\MetaRepository;
use App\Transformers\Response\CityTransformer;

class MetaController extends Controller
{
    public $response = null;
    public $metaRepo = null;
    public function __construct
    (
        WebResponse $response,CityTransformer $countryTransformer
    )
    {
        $this->metaRepo = (new MetaRepoProvider())->repo();
        $this->response = $response;

    }
    public function index()
    {
        return $this->response->setView('meta.meta')->respond(['data'=>[

        ]]);
    }
    public function store(AddMetaRequest $request)
    {
        $this->metaRepo->store($request->getMetaModel());
        return redirect()->back();
    }
    public function all()
    {
        return $this->response->setView('meta.meta_listing')->respond(['data'=>[
            'metas'=>$this->metaRepo->all(),
        ]]);
    }
    public function delete(DeleteMetaRequest $request)
    {
        $this->metaRepo->delete($request->get('id'));
        return redirect()->back();
    }
    public function getUpdatePage(UpdateMetaRequest $request)
    {
        return $this->response->setView('meta.meta_update')->respond(['data'=>[
            'meta'=>$this->metaRepo->getById($request->get('id')),
        ]]);
    }
    public function update(UpdateMetaRequest $request)
    {
        $this->metaRepo->update($request->getMetaModel());
        return redirect('meta-listing');
    }
}
