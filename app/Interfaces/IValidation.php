<?php

namespace App\Interfaces;

use App\Core\AppResult;

interface IValidation {
    /**
     * @param $payload
     * @return mixed
     */
    public function validate($payload)  ;
}
