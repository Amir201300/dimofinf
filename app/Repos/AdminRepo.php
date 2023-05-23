<?php

namespace App\Repos;

use App\Core\AppResult;
use App\Helpers\NumberHelper;
use App\Interfaces\IAdminRepo;
use App\Interfaces\IPostRepo;
use App\Interfaces\IUserRepo;
use App\Models\Admin;
use App\Models\Post;
use App\Models\User;
use Validator,Auth,Artisan,Hash,File,Crypt;

class AdminRepo implements IAdminRepo {
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     */
    public function getSuperAdmin()
    {
        return Admin::first();
    }

}
