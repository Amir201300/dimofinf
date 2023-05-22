<?php

namespace App\Interfaces;

interface IUserRepo {
    /**
     * @param $payload
     * @return mixed
     */
    public function create($payload);

    /**
     * @param $phone
     * @return mixed
     */
    public function getUserByPhone($phone);
}
