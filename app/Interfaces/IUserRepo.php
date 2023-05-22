<?php

namespace App\Interfaces;

interface IUserRepo {
    /**
     * @param $phone
     * @return mixed
     */
    public function getUserByPhone($phone);

    /**
     * @param $payload
     * @return mixed
     */
    public function create($payload);
}
