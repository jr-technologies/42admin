<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Apps\GetAddPropertyWithAuthAppRequest;
use App\Http\Requests\Requests\Apps\GetDashboardAppRequest;
use App\Http\Responses\Responses\WebResponse;


class AppsController extends Controller
{
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
    }

    public function dashboard(GetDashboardAppRequest $appRequest)
    {
        $version = $appRequest->version();
        return $this->response->app('dashboard', $version);
    }
    public function addPropertyWithAuth(GetAddPropertyWithAuthAppRequest $appRequest)
    {
        if(!$appRequest->isNotAuthentic()){
            die(header('Location: '.url('/').'/dashboard#/home/properties/add'));
        }

        $version = $appRequest->version();
        return $this->response->app('addPropertyWithAuth', $version);
    }
}
