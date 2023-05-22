<?php

namespace App\Repos;

use App\Core\AppResult;
use App\Helpers\NumberHelper;
use App\Interfaces\IUserRepo;
use App\Models\User;
use Validator,Auth,Artisan,Hash,File,Crypt;

class UserRepo implements IUserRepo {
    use \App\Traits\ApiResponseTrait;

    /***
     * @param $phone
     * @return AppResult|mixed
     */
    public function getUserByPhone($phone)
    {
        $user=User::where('phone',$phone)->first();
        if(is_null($user))
            return AppResult::error('user not exist');
        return AppResult::success($user);
    }

    /***
     * @param $payload
     * @return User|mixed
     */
    public function create($payload)
    {
        $user=new User();
        $user->username=$payload->username;
        $user->phone=$payload->phone;
        $user->email=$payload->email;
        $user->password=Hash::make($payload->password);
        $user->active_code=NumberHelper::getInstance()->generateCode();
        $user->save();
        return $user;
    }
}
