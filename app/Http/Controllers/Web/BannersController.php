<?php

namespace App\Http\Controllers\Web;

use App\DB\Providers\SQL\Factories\Factories\BannersSizes\BannersSizesFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Banners\AddBannerRequest;
use App\Http\Requests\Requests\Banners\DeleteBannerRequest;
use App\Http\Requests\Requests\Banners\GetAllBannersRequest;
use App\Http\Requests\Requests\Banners\GetBannerRequest;
use App\Http\Requests\Requests\Banners\UpdateBannerRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\BannersRepoProvider;
use App\Repositories\Providers\Providers\LocationsRepoProvider;
use App\Repositories\Providers\Providers\PagesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use App\Traits\Property\PropertyPriceUnitHelper;

class BannersController extends Controller
{
    use PropertyFilesReleaser, PropertyPriceUnitHelper;
    public $users = null;
    public $response = null;
    public $locationRepo=null;
    public $pagesRepo = null;
    public $bannersRepo = null;
    public $bannersSocieties = null;
    public $bannerPages = null;
    public $bannerSize = null;

    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->locationRepo = (new LocationsRepoProvider())->repo();
        $this->pagesRepo = (new PagesRepoProvider())->repo();
        $this->bannersRepo = (new BannersRepoProvider())->repo();
        $this->bannersSocieties = (new BannersRepoProvider())->bannerSocieties();
        $this->bannerPages = (new BannersRepoProvider())->bannerPages();
        $this->bannerSize = (new BannersRepoProvider())->bannerSizes();

    }
    public function banners()
    {
        return $this->response->setView('banners.banners')->respond(['data'=>[
            'locations'=>$this->locationRepo->all(),
            'pages'=>$this->pagesRepo->all(),
            'linkStatus'=>'banner'
        ]]);
    }
    public function bannersListing(GetAllBannersRequest $request)
    {
        return $this->response->setView('banners.banners-listing')->respond(['data'=>[
            'banners'=>$this->bannersRepo->getAllBanners($request->all()),
            'bannerCounts'=>($this->bannersRepo->bannerCount()[0]->total_records),
            'pages'=>$this->pagesRepo->all(),
            'linkStatus'=>'bannerListing'
        ]]);
    }
    public function deleteBanner(DeleteBannerRequest $request)
    {
        $this->bannersRepo->delete($request->get('bannerId'));
        return redirect('banners/listing');
    }
    public function getUpdateBannerForm(GetBannerRequest $request)
    {
        return $this->response->setView('banners.update-banners')->respond(['data'=>[
            'locations'=>$this->locationRepo->all(),
            'pages'=>$this->pagesRepo->all(),
            'bannerSocieties'=> Helper::propertyToArray(($this->bannersSocieties->getByBanner($request->get('bannerId'))),'location_id'),
            'bannerPages'=>Helper::propertyToArray(($this->bannerPages->getByBannerId($request->get('bannerId'))),'page_id'),
            'bannersSize'=>$this->bannerSize->getByBanner($request->get('bannerId')),
            'banner'=>$banner = $this->bannersRepo->getBanner($request->get('bannerId'))
        ]]);
    }
    public function updateBanner(UpdateBannerRequest $request)
    {
        $this->bannersRepo->updateBanner($request->getBannerModel());
        $bannerId = $request->get('id');
        if($request->get('locationIds') !=null && $request->get('locationIds')!="")
        {
            $this->bannersSocieties->deleteBannerSocieties($bannerId);
            $this->saveBannerSocieties($request->get('locationIds'),$bannerId);
        }
        if($request->get('area') !=null && $request->get('area')!="")
        {
            $this->bannerSize->deleteBannerSize($bannerId);
            $this->saveBannerSizes($bannerId,$request->get('area'),$request->get('unit'));
        }
        if($request->get('pagesIds') !=null && $request->get('pagesIds')!="")
        {
            $this->bannerPages->deleteBannerPages($bannerId);
            $this->saveBannerPages($bannerId,$request->get('pagesIds'));
        }
        return redirect('banners/listing');
    }
    public function addBanner(AddBannerRequest $request)
    {
        $bannerId = $this->saveBanner($request);

        if($request->get('locationIds')[0] !=null && $request->get('locationIds')[0] != "")
        {
            $this->saveBannerSocieties($request->get('locationIds'),$bannerId);
        }
        if($request->get('area')[0] !=null && $request->get('area')[0] != "")
        {
            $this->saveBannerSizes($bannerId,$request->get('area'),$request->get('unit'));
        }
        if($request->get('pagesIds')[0] !=null && $request->get('pagesIds')[0] !="")
        {
            $this->saveBannerPages($bannerId,$request->get('pagesIds'));
        }
        return redirect('banners/listing');
    }

    public function saveBanner(AddBannerRequest $request)
    {
       return $this->bannersRepo->saveBanner($request->getBannerModel());
    }
    public function saveBannerSocieties(array $locations,$bannerId)
    {
        return $this->bannersRepo->saveSocieties( $locations,$bannerId);
    }

    public function saveBannerSizes($bannerId,$area,$unit)
    {
        return $this->bannersRepo->saveBannerSizes($bannerId,$area,$unit);
    }
    public function saveBannerPages($bannerId,$pageIds)
    {
        return $this->bannersRepo->saveBannerPages($bannerId,$pageIds);
    }

}
