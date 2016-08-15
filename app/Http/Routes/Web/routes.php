<?php

Route::get('foo',function()
{
   // DB::table('properties')->delete();
    $lastProperty =  DB::table('properties')
                    ->orderBy('properties.id','DESC')
                    ->skip(0)->take(1)->get();
    $lastId = $lastProperty[0]->id;
    $statusesSeeder = new PropertyStatusTableSeeder();
    $PropertyFactory = (new \App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory());
    $activeStatus = $statusesSeeder->getActiveStatusId();


    for($b = 1; $b<=2; $b++) {
        $allProperties = [];
        for ($a = 1; $a <= 200; $a++) {
            $temp = [];
            $temp['purpose_id'] = rand(1, 2);
            $temp['property_sub_type_id'] = rand(1, 19);
            $temp['block_id'] = rand(1, 11045);
            $temp['title'] = 'This is my property';
            $temp['description'] = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.' . rand(1, 200002);
            $temp['price'] = rand(2000000, 250000000);
            $temp['land_area'] = rand(1, 20);
            $temp['land_unit_id'] = rand(1, 4);
            $temp['contact_person'] = 'ab' . rand(1, 100000);
            $temp['phone'] = '0321450405' . rand(1, 3);
            $temp['mobile'] = '0321450405' . rand(1, 10);
            $temp['wanted'] = rand(0,1);
            $temp['property_status_id'] = $activeStatus;
            $temp['total_views'] = rand(1, 100000);
            $temp['rating'] = rand(1, 10);
            $temp['total_likes'] = rand(1, 100000);
            $temp['email'] = 'jrpropedrty167@gmail.com' . rand(1, 1000000);
            $temp['owner_id'] = rand(1, 2);
            $temp['created_by'] = 1;
            $temp['created_at'] = date('Y-m-d h:i:s');
            $temp['updated_at'] = date('Y-m-d h:i:s');
            $allProperties[] = $temp;

        }
        DB::table('properties')->insert($allProperties);
    }
    $allProperties = $PropertyFactory->mapCollection( DB::table('properties')->select('properties.*')->where('properties.id','>',$lastId)->get());
    $finalResult =[];
    foreach($allProperties as $property)
    {
        $propertyJson = (new \App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator($property))->create();
        $finalResult[] = ['property_id' => $property->id, 'json'=> json_encode($propertyJson)];
    }
    DB::table('property_json')->insert($finalResult);
    return view('frontend.foo');

});

Route::get('foo/blocks',function(){
    $societyTable = (new \App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory())->getTable();
    $blocks = DB::table('blocks')
        ->select('blocks.society_id')
        ->groupBy('blocks.society_id')
        ->where('blocks.block','other')
        ->get();
     $blocks = (new \App\Libs\Helpers\Helper())->propertyToArray($blocks,'society_id');
     $societies = DB::table($societyTable)
        ->select($societyTable.'.*')
        ->whereNotIn($societyTable.'.id', $blocks)
        ->get();
    $insertBlocks =[];
    foreach($societies as $society)
    {
        $insertBlocks[] = ['society_id'=>$society->id,'block'=>'other'];
    }
    DB::table('blocks')->insert($insertBlocks);
});

Route::get('print-societies/12345',function(){
        $allSocieties = (new \App\Repositories\Repositories\Sql\SocietiesRepository())->all();
        foreach($allSocieties as $society)
        {
            echo '(object)[
               "id"=>'.$society->id.' ,"name"=>'."'".$society->name."'".'
           ],<br />';
        }
    }
);

Route::get('maliksajidawan786@gmail.com/societies',
    [
        'middleware'=>
            [
                'webValidate:getAllSocietiesRequest'
            ],
        'uses'=>'Admin\AdminController@societies'
    ]
);

Route::get('maliksajidawan786@gmail.com/blocks',
    [
        'middleware'=>
            [],
        'uses'=>'Admin\AdminController@getBlocks'
    ]
);

Route::post('add/blocks',
    [
        'middleware'=>
            [
               'webValidate:addBlockRequest'
            ],
        'uses'=>'Admin\AdminController@addBlock'
    ]
);

Route::post('delete/blocks',
    [
        'middleware'=>
            [
                'webValidate:deleteBlockRequest'
            ],
        'uses'=>'Admin\AdminController@deleteBlock'
    ]
);

Route::post('update/blocks',
    [
        'middleware'=>
            [
               'webValidate:updateBlockRequest'
            ],
        'uses'=>'Admin\AdminController@updateBlock'
    ]
);

Route::post('get/update/block/form',
    [
        'middleware'=>
            [
                'webValidate:getUpdateBlockFormRequest'
            ],
        'uses'=>'Admin\AdminController@getBlockUpdateForm'
    ]
);

Route::post('delete/society',
    [
        'middleware'=>
            [
                'webValidate:deleteSocietyRequest'
            ],
        'uses'=>'Admin\AdminController@deleteSociety'
    ]
);

Route::post('update/society',
    [
        'middleware'=>
            [
                'webValidate:updateSocietyRequest'
            ],
        'uses'=>'Admin\AdminController@updateSociety'
    ]
);

Route::post('get/update/society/form',
    [
        'middleware'=>
            [
                'webValidate:getUpdateSocietyFormRequest'
            ],
        'uses'=>'Admin\AdminController@getUpdateSocietyForm'
    ]
);

Route::post('add/society',
    [
        'middleware'=>
            [
                'webValidate:addSocietyRequest'
            ],
        'uses'=>'Admin\AdminController@addSociety'
    ]
);

Route::get('get/society/form',
    [
        'middleware'=>
            [

            ],
        'uses'=>'Admin\AdminController@getSocietyForm'
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

Route::get('get/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@getById'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/active/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminActivePropertyRequest'
            ],
        'uses'=>'Admin\AdminController@getActiveProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/expired/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminExpiredPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@getExpiredProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/rejected/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminRejectedPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@getRejectedProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/deleted/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminDeletedPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@getDeletedProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/pending/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminPendingPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@getPendingProperties'
    ]
);

Route::get('get/agent',
    [
        'middleware'=>
            [
                'webValidate:getAdminAgentRequest'
            ],
        'uses'=>'Admin\AdminController@getAgent'
    ]
);

Route::get('add-property',
    [
        'uses'=>'PropertiesController@addProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/reject',
    [
        'middleware'=>
            [
                'webValidate:RejectPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@rejectProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/verify',
    [
        'middleware'=>
            [
                'webValidate:verifyPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@VerifyProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/deActive',
    [
        'middleware'=>
            [
                'webValidate:deActivePropertyRequest'
            ],
        'uses'=>'Admin\AdminController@deActiveProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/deVerify',
    [
        'middleware'=>
            [
                'webValidate:deVerifyPropertyRequest'
            ],
        'uses'=>'Admin\AdminController@deVerifyProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/approve',
    [
        'middleware'=>
            [
                'webValidate:ApprovePropertyRequest'
            ],
        'uses'=>'Admin\AdminController@approveProperty'
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


Route::post('admin/property/approve',
    [
        'middleware'=>
            [
                'webValidate:ApprovePropertyRequest'
            ],
        'uses'=>'Admin\AdminController@approveProperty'
    ]
);

Route::post('admin/agent/approve',
    [
        'middleware'=>
            [
//                'webAuthenticate:getAdminsPropertiesRequest',
                'webValidate:approveAgentRequest'
            ],
        'uses'=>'Admin\AdminController@approveAgent'
    ]
);

Route::get('society/doc/download',
    [
        'middleware'=>
            [
                'webValidate:downloadSocietyAffidavitRequest'
            ],
        'uses'=>'SocietiesController@getSocietyDoc'
    ]);

Route::get('society/image/download',
    [
        'middleware'=>
            [
                'webValidate:downloadSocietyAffidavitRequest'
            ],
        'uses'=>'SocietiesController@getSocietyImage'
    ]);

Route::get('society/pdf/download',
    [
        'middleware'=>
            [
                'webValidate:downloadSocietyFilesRequest'
            ],
        'uses'=>'SocietiesController@downloadSocietyPDF'
    ]);

Route::get('get/society/files',
    [
        'middleware'=>
            [
                'webValidate:GetSocietyFilesRequest'
            ],
        'uses'=>'SocietiesController@getSocietyFiles'
    ]);



Route::get('societies/files',
    [
        'middleware'=>
            [
                'webValidate:GetAllSocietiesForFilesRequest'
            ],
        'uses'=>'SocietiesController@getAllSocietiesForFiles'
    ]);

Route::get('societies/maps',
    [
        'middleware'=>
            [
                'webValidate:GetAllSocietiesForMapsRequest'
            ],
        'uses'=>'SocietiesController@getAllSocietiesForMaps'
    ]);

Route::get('society/maps',
    [
        'middleware'=>
            [
                'webValidate:GetSocietyMapsRequest'
            ],
        'uses'=>'SocietiesController@getSocietyMaps'
    ]);

Route::get('maliksajidawan786@gmail.com/properties',
    [
        'middleware'=>
            [
                'webAuthenticate:getAdminsPropertiesRequest',
            ],
        'uses'=>'Admin\AdminController@getProperties'
    ]);

Route::get('maliksajidawan786@gmail.com/agents',
    [
        'middleware'=>
            [
                //'webAuthenticate:getAdminsPropertiesRequest',
            ],
        'uses'=>'Admin\AdminController@getAgents'
    ]);
Route::get('society',
    [
        'middleware'=>
            [
                'webValidate:getSocietyRequest'
            ],
        'uses'=>'Admin\PropertiesController@getSociety'
    ]
);


Route::get('/login',
    [
        'uses'=>'Auth\AuthController@showLoginPage', 'as'=>'loginPage'
    ]
);

Route::post('/login',
    [
        'middleware'=>
            [
                'webValidate:loginRequest'
            ],
        'uses'=>'Auth\AuthController@login', 'as' =>'login'
    ]
);


Route::get('/',
    [
        'middleware'=>
            [
                'webValidate:indexRequest'
            ],
        'uses'=>'PropertiesController@index',
    ]
);

Route::post('feedback',
    [
        'middleware'=>
            [
                'webValidate:feedbackRequest'
            ],
        'uses'=>'MailController@feedback',
    ]
);

Route::get('search',
    [
        'middleware'=>
            [
                //'webValidate:searchRequest'
            ],
        'uses'=>'PropertiesController@search',
    ]
);

Route::post('get-new-password',
    [
        'middleware'=>
            [
                'webValidate:forgetPasswordRequest'
            ],
        'uses'=>'UsersController@getNewPassword',
    ]
);

Route::get('forget-password',
    [
        'middleware'=>
            [
                //'webValidate:forgetPasswordRequest'
            ],
        'uses'=>'UsersController@forgetPassword',
    ]
);

Route::get('/register',
    [
        'uses'=>'Auth\AuthController@showRegisterPage'
    ]
);
Route::post('/register',
    [
        'middleware'=>
            [
                'webValidate:registrationRequest'
            ],
        'uses'=>'Auth\AuthController@register',
        'as' => 'register'
    ]
);

Route::get('property',
    [
        'middleware'=>
            [
                'webValidate:getPropertyRequest'
            ],
        'uses'=>'PropertiesController@getById'
    ]
);


Route::get('agents',
    [
        'middleware'=>
            [
                'webValidate:getAgentsRequest'
            ],
        'uses'=>'UsersController@trustedAgents'
    ]
);

Route::get('agent',
    [
        'middleware'=>
            [
                'webValidate:getAgentRequest'
            ],
        'uses'=>'UsersController@getTrustedAgent'
    ]
);

Route::get('agent/mail',
    [
    'middleware'=>
        [
            'webValidate:agentMailRequest'
        ],
    'uses'=>'MailController@mailAgent'
]);

Route::post('mail-to-agent',
    [
        'middleware'=>
            [
                'webValidate:mailToAgentRequest'
            ],
        'uses'=>'MailController@mailToAgent'
    ]);


Route::post('property/wanted',
    [
        'middleware'=>
            [
                'webValidate:wantedMailRequest'
            ],
        'uses'=>'MailController@propertyWanted'
    ]);

Route::post('contact_us',
    [
        'middleware'=>
            [
                'webValidate:contactUSMailRequest'
            ],
        'uses'=>'MailController@contactUS'
    ]);
Route::post('property-to-friend',
    [
        'middleware'=>
            [
                'webValidate:mailPropertyToFriendRequest'
            ],
        'uses'=>'MailController@mailToFriend'
    ]);

/**
trusted-agent route is not redirect on right path its temporary
**/

Route::post('trusted-agent',
    [
        'middleware'=>
            [
                'webValidate:trustedAgentRequest'
            ],
        'uses'=>'UsersController@makeTrustedAgent'
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