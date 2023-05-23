<?php

namespace App\Interfaces;

interface IPostRepo {
    /**
     * @param $filter
     * @return mixed
     */
    public function getPosts($filter);

    /**
     * @return mixed
     */
    public function getDailyPosts();

    /**
     * @param $id
     * @return mixed
     */
    public function getPostById($id);

    /**
     * @param $payload
     * @return mixed
     */
    public function create($payload);

    /**
     * @param $payload
     * @param $post
     * @return mixed
     */
    public function update($payload,$post);

    /**
     * @param $post
     * @return mixed
     */
    public function delete($post);


}
