<?php

namespace App\Interfaces;

interface IPostRepo {
    /**
     * @param $filter
     * @return mixed
     */
    public function getPosts($filter);
    /**
     * @param $payload
     * @return mixed
     */
    public function create($payload);

    /**
     * @param $id
     * @return mixed
     */
    public function getPostById($id);
}
