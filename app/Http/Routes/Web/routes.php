<?php

/**  Banner Routes */


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



Route::get('admin/logout',function(){

    if(session()->has('admin'))
    {
        session()->pull('admin');
    }
    return redirect('admin');
});
Route::get('maliksajidawan786@gmail.com/agents',
    [
        'middleware'=>
            [
            ],
        'uses'=>'Admin\AdminController@getAgents'
    ]);


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
    return redirect('/login');
});