<?php

namespace App\Interfaces;

interface IUserRepo {
    /**
     * @param $filter
     * @return mixed
     */
    public function getUsers($filter);

    /**
     * @return mixed
     */
    public function getDailyUsers();

    /**
     * @param $id
     * @return mixed
     */
    public function getUserById($id);
    /***
     * @param $phone
     * @return mixed
     */
    public function getUserByPhone($phone);

    /**
     * @param $payload
     * @return mixed
     */
    public function create($payload);

    /**
     * @param $payload
     * @param $user
     * @return mixed
     */
    public function update($payload,$user);

    /**
     * @param $user
     * @return mixed
     */
    public function delete($user);
}
