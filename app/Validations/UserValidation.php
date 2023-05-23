<?php

namespace App\Validations;

use App\Core\AppResult;
use App\Interfaces\IValidation;
use Validator,Auth;

class UserValidation implements IValidation
{
    /***
     * @param $payload
     *  i can customize error messages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function validate($payload)
    {
        $input = $payload->all();
        $user_id=$payload->user_id ? $payload->user_id : null;
        $validator = Validator::make($input, [
            'phone' => $user_id  ? 'required|unique:users,phone,'.$user_id :'required|unique:users' ,
            'email' => $user_id  ? 'required|unique:users,email,'.$user_id.'|regex:/(.+)@(.+)\.(.+)/i' : 'required|unique:users|regex:/(.+)@(.+)\.(.+)/i',
            'username' =>  'required' ,
            'password' => $user_id ? '' : 'required'  ,
        ]);
        if ($validator->fails()) {
            return AppResult::error($validator->messages()->first());
        }
        return AppResult::success(null);
    }
}
