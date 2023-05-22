<?php

namespace App\Validations;

use App\Core\AppResult;
use App\Interfaces\IValidation;
use Validator,Auth;

class PostValidation implements IValidation
{
    /***
     * @param $payload
     *  i can customize error messages
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function validate($payload)
    {
        $input = $payload->all();
        $validationMessages = [
            'description.max' =>"Description is limited to 2 KB" ,
        ];
        $validator = Validator::make($input, [
            'title' =>  'required' ,
            'description' =>  'required|max:2000' ,
            'phone' =>  'required|numeric|min:11' ,
        ],$validationMessages);
        if ($validator->fails()) {
            return AppResult::error($validator->messages()->first());
        }
        return AppResult::success(null);
    }
}
