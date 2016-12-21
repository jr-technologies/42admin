<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Auth\AdminLoginRequest;
use App\Http\Responses\Responses\WebResponse;
use App\Repositories\Providers\Providers\AdminsRepoProvider;
use App\Traits\Property\PropertyFilesReleaser;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use PropertyFilesReleaser;
    public $adminRepo = null;
    public function __construct(WebResponse $webResponse)
    {
        $this->response = $webResponse;
        $this->adminRepo = (new AdminsRepoProvider())->repo();
    }
    public function getLoginPage()
    {
        return $this->response->setView('auth.login')->respond(['data'=>'']);
    }
    public function login(AdminLoginRequest $request)
    {
        $admin = $this->adminRepo->getAdmin($request->getCredentials());
        if(sizeof($admin) >0)
        {
            if(md5($request->get('password')) == $admin->password)
            {
                Session::set('admin',$admin);
                return redirect('/get/active/property');
            }
            else{
                Session::flash('message', 'Invalid Email or Password');
                return redirect('/');
            }
        }
        Session::flash('message', 'Invalid Email or Password');
        return redirect('/');
    }
}
