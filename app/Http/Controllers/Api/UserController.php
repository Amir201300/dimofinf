<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SmsHelper;
use App\Interfaces\IUserRepo;
use App\Validations\UserValidation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    private $userRepo;
    private $userValidation;

    public function __construct(IUserRepo $userRepo,UserValidation $userValidation)
    {
        $this->userRepo = $userRepo;
        $this->userValidation = $userValidation;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(Request $request){
        $response=$this->userRepo->getUserByPhone($request->phone);
        if($response->operationType==ERROR)
            return $this->apiResponseMessage(0,$response->error);
        $user=$response->data;
        $password = Hash::check($request->password, $user->password);
        if ($password == false)
            return $this->apiResponseMessage(0, 'Password is not correct', 200);
        $this->putTokenInUser($user);
        return $this->apiResponseData(new UserResource($user));
    }


    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(Request $request){
        $validateUser=$this->userValidation->validate($request);
        if($validateUser->operationType==ERROR)
            return $this->apiResponseMessage(0,$validateUser->error,400);
        $request['status']=2;
        $user=$this->userRepo->create($request);
        $this->putTokenInUser($user);
        SmsHelper::getInstance()->sendSmsUsingTwilio($user->phone,'your code is '. $user->active_code);
        return $this->apiResponseData(new UserResource($user));
    }

    /***
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function my_info(){
        return $this->apiResponseData(new UserResource(Auth::user()));
    }

    /**
     * @param $user
     * @return mixed
     */
    private function putTokenInUser($user){
        return  $user['user_token'] = $user->createToken('TutsForWeb')->accessToken;
    }
}
