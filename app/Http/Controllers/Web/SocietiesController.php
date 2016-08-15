<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Society\DownloadSocietyFilesRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesForFilesRequest;
use App\Http\Requests\Requests\Society\GetAllSocietiesForMapsRequest;
use App\Http\Requests\Requests\Society\GetSocietyFilesRequest;
use App\Http\Requests\Requests\Society\GetSocietyMapsRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\SocietiesFilesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Repositories\Sql\SocietiesFilesRepository;
use App\Repositories\Repositories\Sql\SocietiesMapsRepository;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;
use App\Traits\Property\ShowAddPropertyFormHelper;
use App\Transformers\Response\PropertyTransformer;

class SocietiesController extends Controller
{
    public function __construct(WebResponse $webResponse, PropertyTransformer $propertyTransformer)
    {

    }
}
