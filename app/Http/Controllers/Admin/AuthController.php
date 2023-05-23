<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    public function loginForm (){
        return view('Admin.loginAdmin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Admin.dashboard');
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if (Auth::guard('Admin')->attempt($credentials)) {

            return $this->apiResponseMessage(1,'success');
        }
        return $this->apiResponseMessage(0,'error');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::guard('Admin')->logout();
        return redirect(route('admin.loginForm'));

    }
}
