<?php

namespace App\Repos;

use App\Core\AppResult;
use App\Helpers\NumberHelper;
use App\Interfaces\IPostRepo;
use App\Interfaces\IUserRepo;
use App\Models\Post;
use App\Models\User;
use Validator,Auth,Artisan,Hash,File,Crypt;

class PostRepo implements IPostRepo {
    use \App\Traits\ApiResponseTrait;

    /**
     * @param $filter
     * @return mixed
     */
    public function getPosts($filter)
    {
        $posts=Post::orderBy('id','desc');
        if($filter->user_id)
            $posts=$posts->where('user_id',$filter->user_id);
        if($filter->not_id)
            $posts=$posts->where('user_id','!=',$filter->not_id);
        if($filter->not_paginate)
            $posts=$posts->get();
        else
            $posts=$posts->paginate(10);
        return $posts;
    }

    /**
     * @return mixed
     */
    public function getDailyPosts()
    {
        return Post::whereDay('created_at',now())->get();
    }

    /**
     * @param $id
     * @return AppResult|mixed
     */
    public function getPostById($id)
    {
        $post=Post::where('id',$id)->first();
        if(is_null($post))
            return AppResult::error('post not exist');
        return AppResult::success($post);
    }

    /**
     * @param $payload
     * @return Post|mixed
     */
    public function create($payload)
    {
        $post=new Post();
        $post->user_id=$payload->user_id;
        $post->title=$payload->title;
        $post->description=$payload->description;
        $post->phone=$payload->phone;
        $post->save();
        return $post;
    }

    /***
     * @param $payload
     * @param $post
     * @return mixed
     */
    public function update($payload,$post)
    {
        $post->user_id=$payload->user_id;
        $post->title=$payload->title;
        $post->description=$payload->description;
        $post->phone=$payload->phone;
        $post->save();
        return $post;
    }

    /**
     * @param $post
     * @return mixed|void
     */
    public function delete($post)
    {
        $post->delete();
    }


}
