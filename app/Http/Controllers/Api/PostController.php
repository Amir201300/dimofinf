<?php

namespace App\Http\Controllers\Api;

use App\Helpers\NotificationHelper;
use App\Http\Resources\Collections\PostCollection;
use App\Http\Resources\PostResource;
use App\Interfaces\IAdminRepo;
use App\Interfaces\IPostRepo;
use App\Validations\PostValidation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Artisan,Hash,File,Crypt;

class PostController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    private $postRepo;
    private $postValidation;
    private $adminRepo;

    public function __construct(IPostRepo $postRepo,PostValidation $postValidation,IAdminRepo $adminRepo)
    {
        $this->postRepo = $postRepo;
        $this->postValidation = $postValidation;
        $this->adminRepo = $adminRepo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function posts(Request $request){
        $request['not_id']=Auth::user()->id;
        $posts=$this->postRepo->getPosts($request);
        return $this->apiResponseData(new PostCollection($posts));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function save_post(Request $request){
        $validatePost=$this->postValidation->validate($request);
        if($validatePost->operationType==ERROR)
            return $this->apiResponseMessage(0,$validatePost->error,400);
        $request['user_id']=Auth::user()->id;
        $post=$this->postRepo->create($request);
        NotificationHelper::getInstance()->sendNotification($this->adminRepo->getSuperAdmin()->firebase_token,'new post','new post published');
        return $this->apiResponseData(new PostResource($post));
    }


}
