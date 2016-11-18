<?php

/**  Banner Routes */

Route::post('set/priority',
    [
        'middleware'=>
            [

            ],
        'uses'=>'Admin\AdminController@setPriority'
    ]);

Route::get('get/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getById'
    ]
);

Route::post('get-properties-by-User',
    [
        'middleware'=>
            [
               // 'webValidate:getAdminPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getPropertiesByUser'
    ]
);

Route::get('all/property/listing',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\AdminController@allPropertyListing'
    ]
);

Route::get('get/active/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminActivePropertyRequest'
            ],
        'uses'=>'admin\AdminController@getActiveProperties'
    ]
);

Route::get('get/expired/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminExpiredPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getExpiredProperties'
    ]
);

Route::get('get/rejected/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminRejectedPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getRejectedProperties'
    ]
);

Route::get('get/deleted/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminDeletedPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getDeletedProperties'
    ]
);

Route::get('get/pending/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminPendingPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getPendingProperties'
    ]
);


Route::get('banners',
    [
        'middleware'=>
            [

            ],
        'uses'=>'BannersController@banners'
    ]
);

Route::post('add/banner',
    [
        'middleware'=>
            [
                'webValidate:addBannerRequest'
            ],
        'uses'=>'BannersController@addBanner'
    ]
);

Route::get('banners/listing',
    [
        'middleware'=>
            [
                'webValidate:getAllBannersRequest'
            ],
        'uses'=>'BannersController@bannersListing'
    ]
);

Route::post('delete/banner',
    [
        'middleware'=>
            [
                'webValidate:deleteBannerRequest'
            ],
        'uses'=>'BannersController@deleteBanner'
    ]
);

Route::post('get/update/banner/form',
    [
        'middleware'=>
            [
                'webValidate:getBannerRequest'
            ],
        'uses'=>'BannersController@getUpdateBannerForm'
    ]
);

Route::post('update/banner',
    [
        'middleware'=>
            [
                'webValidate:updateBannerRequest'
            ],
        'uses'=>'BannersController@updateBanner'
    ]
);
/** End Here */



Route::get('users',
    [
        'middleware'=>
            [
                //'webValidate:getUsersRequest'
            ],
        'uses'=>'UsersController@searchUserPage'
    ]
);
Route::get('get/users',
    [
        'middleware'=>
            [
                'webValidate:getUsersRequest'
            ],
        'uses'=>'UsersController@search'
    ]
);

Route::post('delete/user',
    [
        'middleware'=>
            [
                //'webValidate:getUsersRequest'
            ],
        'uses'=>'UsersController@delete'
    ]
);

Route::get('admin',
    [
        'middleware'=>
            [

            ],
        'uses'=>'Admin\AuthController@getLoginPage'
    ]
);


Route::post('admin/login',
    [
        'middleware'=>
            [
                // 'webAuthenticate:adminLoginRequest',
                'webValidate:adminLoginRequest'
            ],
        'uses'=>'Admin\AuthController@login'
    ]
);

Route::post('property/reject',
    [
        'middleware'=>
            [
                'webValidate:RejectPropertyRequest'
            ],
        'uses'=>'admin\AdminController@rejectProperty'
    ]
);

Route::post('property/verify',
    [
        'middleware'=>
            [
                'webValidate:verifyPropertyRequest'
            ],
        'uses'=>'admin\AdminController@VerifyProperty'
    ]
);

Route::post('property/deActive',
    [
        'middleware'=>
            [
                'webValidate:deActivePropertyRequest'
            ],
        'uses'=>'admin\AdminController@deActiveProperty'
    ]
);

Route::post('property/deVerify',
    [
        'middleware'=>
            [
                'webValidate:deVerifyPropertyRequest'
            ],
        'uses'=>'admin\AdminController@deVerifyProperty'
    ]
);

Route::post('property/approve',
    [
        'middleware'=>
            [
                'webValidate:ApprovePropertyRequest'
            ],
        'uses'=>'admin\AdminController@approveProperty'
    ]
);

Route::post('property/delete',
    [
        'middleware'=>
            [
                'webValidate:softDeletePropertyRequest'
            ],
        'uses'=>'admin\AdminController@softDeleteProperty'
    ]
);

Route::post('property/deleted',
    [
        'middleware'=>
            [
                'webValidate:softDeletePropertyRequest'
            ],
        'uses'=>'admin\AdminController@deleteProperty'
    ]
);

Route::get('get/pending/agent',
    [
        'middleware'=>
            [
                'webValidate:getAdminAgentsRequest'
            ],
        'uses'=>'Admin\AdminController@getPendingAgents'
    ]);
Route::get('get/active/agent',
    [
        'middleware'=>
            [
                'webValidate:getAdminAgentsRequest'
            ],
        'uses'=>'Admin\AdminController@getActiveAgents'
    ]);

Route::post('make/agent/active',
    [
        'middleware'=>
            [
                'webValidate:trustedAgentRequest'
            ],
        'uses'=>'Admin\AdminController@makeTrustedAgent'
    ]);

Route::post('make/agent/deActive',
    [
        'middleware'=>
            [
                'webValidate:trustedAgentRequest'
            ],
        'uses'=>'Admin\AdminController@makeNotTrustedAgent'
    ]);

Route::post('agent/delete',
    [
        'middleware'=>
            [
                'webValidate:trustedAgentRequest'
            ],
        'uses'=>'Admin\AdminController@deleteAgent'
    ]);

Route::get('admin/logout',function(){

    if(session()->has('admin'))
    {
        session()->pull('admin');
    }
    return redirect('admin');
});


Route::get('city',
    [
        'middleware'=>
            [
            ],
        'uses'=>'CitiesController@index'
    ]
);

Route::post('add/city',
    [
        'middleware'=>
            [
                'webValidate:addCityRequest'
            ],
        'uses'=>'CitiesController@store'
    ]
);

Route::get('cities/listing',
    [
        'middleware'=>
            [
            ],
        'uses'=>'CitiesController@getAllCities'
    ]
);


Route::post('get/update/city/form',
    [
        'middleware'=>
            [
            ],
        'uses'=>'CitiesController@getCityUpdateForm'
    ]
);

Route::post('update/city',
    [
        'middleware'=>
            [
                'webValidate:UpdateCityRequest'
            ],
        'uses'=>'CitiesController@update'
    ]
);

Route::post('delete/city',
    [
        'middleware'=>
            [
                'webValidate:deleteCityRequest'
            ],
        'uses'=>'CitiesController@delete'
    ]
);


Route::get('location',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\LocationsController@index'
    ]
);

Route::post('add/location',
    [
        'middleware'=>
            [
                'webValidate:addLocationRequest'
            ],
        'uses'=>'admin\LocationsController@store'
    ]
);

Route::get('location/listing',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\LocationsController@listing'
    ]
);

Route::get('get/location/by/City',
    [
        'middleware'=>
            [
                'webValidate:getLocationByCityRequest'
            ],
        'uses'=>'admin\LocationsController@getByCity'
    ]
);

Route::post('get/update/location/form',
    [
        'middleware'=>
            [
                'webValidate:getLocationRequest'
            ],
        'uses'=>'admin\LocationsController@getUpdateLocationForm'
    ]
);

Route::post('update/location',
    [
        'middleware'=>
            [
                'webValidate:updateLocationRequest'
            ],
        'uses'=>'admin\LocationsController@update'
    ]
);


Route::post('delete/location',
    [
        'middleware'=>
            [
                'webValidate:deleteLocationRequest'
            ],
        'uses'=>'admin\LocationsController@delete'
    ]
);






Route::get('news',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\NewsController@news'
    ]
);

Route::post('add/news',
    [
        'middleware'=>
            [
                'webValidate:addNewsRequest'
            ],
        'uses'=>'admin\NewsController@addNews'
    ]
);

Route::get('news/listing',
    [
        'middleware'=>
            [
                'webValidate:getAllNewsRequest'
            ],
        'uses'=>'admin\NewsController@getAllNews'
    ]
);

Route::post('delete/news',
    [
        'middleware'=>
            [
                'webValidate:deleteNewsRequest'
            ],
        'uses'=>'admin\NewsController@deleteNews'
    ]
);

Route::post('update/news',
    [
        'middleware'=>
            [
                'webValidate:updateNewsRequest'
            ],
        'uses'=>'admin\NewsController@updateNews'
    ]
);

Route::post('delete/news/image',
    [
        'middleware'=>
            [
                'webValidate:deleteNewsImageRequest'
            ],
        'uses'=>'admin\NewsController@deleteNewsImage'
    ]
);

Route::get('get/news/images',
    [
        'middleware'=>
            [
                'webValidate:getNewsImagesRequest'
            ],
        'uses'=>'admin\NewsController@getNewsImages'
    ]
);

Route::post('get/update/news/form',
    [
        'middleware'=>
            [
                'webValidate:getNewsRequest'
            ],
        'uses'=>'admin\NewsController@getNews'
    ]
);



//-------------------------------------projects----------------------------------



Route::get('project',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\ProjectsController@project'
    ]
);

Route::post('add/project',
    [
        'middleware'=>
            [
                'webValidate:addProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@addProject'
    ]
);

Route::get('project/listing',
    [
        'middleware'=>
            [
                'webValidate:getAllProjectsRequest'
            ],
        'uses'=>'admin\ProjectsController@getAllProjects'
    ]
);

Route::post('delete/project',
    [
        'middleware'=>
            [
                'webValidate:deleteProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@deleteProject'
    ]
);




Route::post('update/project',
    [
        'middleware'=>
            [
                'webValidate:updateProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@updateProject'
    ]
);

Route::post('delete/image',
    [
        'middleware'=>
            [
                'webValidate:deleteProjectImageRequest'
            ],
        'uses'=>'admin\ProjectsController@deleteProjectImage'
    ]
);

Route::get('get/project/images',
    [
        'middleware'=>
            [
                'webValidate:getProjectImagesRequest'
            ],
        'uses'=>'admin\ProjectsController@getProjectImages'
    ]
);

Route::post('get/update/project/form',
    [
        'middleware'=>
            [
                'webValidate:getProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@updateProjectForm'
    ]
);

Route::get('features',
    [
        'middleware'=>
            [],
        'uses'=>'FeaturesController@index'
    ]
);
Route::post('add/feature',
    [
        'middleware'=>
            [
              'webValidate:addFeatureRequest'
            ],
        'uses'=>'FeaturesController@store'
    ]
);



Route::get('/',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\AuthController@getLoginPage'
    ]
);


Route::post('admin/login',
    [
        'middleware'=>
            [
                // 'webAuthenticate:adminLoginRequest',
                'webValidate:adminLoginRequest'
            ],
        'uses'=>'admin\AuthController@login'
    ]
);





Route::get('/logout', function(){
    if(session()->has('authUser'))
    {
        $usersRepo = (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo();
        $authUser = session()->pull('authUser');
        try{
            $authUser = $usersRepo->getById($authUser->id);
            $authUser->access_token = null;
            (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo()->update($authUser);
        }catch (\Exception $e){

        }
    }
    return redirect('/');
});