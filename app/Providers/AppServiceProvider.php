<?php

namespace App\Providers;

use App\Libs\Auth\Web;
use App\Repositories\Repositories\Sql\PropertyTypeRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $propertyTypes;
    public $email;
    public function __construct()
    {
        $this->propertyTypes = new PropertyTypeRepository();
        $this->email =
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $data = [
            'propertyTypes' =>$this->propertyTypes->all(),
            'authUser' => (new Web())->user()
        ];
        view()->share('globals', $data);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
