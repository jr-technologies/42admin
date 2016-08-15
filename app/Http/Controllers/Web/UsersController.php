<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\User\AddUserRequest;
use App\Http\Requests\Requests\User\ForgetPasswordRequest;
use App\Http\Requests\Requests\User\GetAgentRequest;
use App\Http\Requests\Requests\User\GetAgentsRequest;
use App\Http\Requests\Requests\User\GetUsersRequest;
use App\Http\Requests\Requests\User\SearchUsersRequest;
use App\Http\Requests\Requests\User\TrustedAgentRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Libs\Helpers\Helper;
use App\Repositories\Providers\Providers\PropertiesRepoProvider;
use App\Repositories\Providers\Providers\RolesRepoProvider;
use App\Repositories\Providers\Providers\SocietiesRepoProvider;
use App\Repositories\Providers\Providers\UserRolesRepoProvider;
use App\Repositories\Providers\Providers\UsersJsonRepoProvider;
use App\Repositories\Providers\Providers\UsersRepoProvider;
use App\Traits\User\UsersFilesReleaser;
use App\Transformers\Response\UserTransformer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public $response;
    public $userRepo = null;
    public $userRoles =null;
    public function __construct(WebResponse $webResponse, UserTransformer $userTransformer)
    {
        $this->response = $webResponse;
        $this->userRoles = (new RolesRepoProvider())->repo();
        $this->userRepo = (new UsersJsonRepoProvider())->repo();
    }
    public function searchUserPage()
    {
        return $this->response->setView('users')->respond(['data'=>[
            'roles'=>$this->userRoles->all()
        ]]);
    }
    public function search(GetUsersRequest $request)
    {
        return $this->response->setView('users')->respond(['data'=>[
            'users'=>$this->userRepo->search($request->all()),
            'roles'=>$this->userRoles->all()
        ]]);

    }
}
