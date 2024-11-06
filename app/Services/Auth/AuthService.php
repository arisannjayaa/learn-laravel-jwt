<?php

namespace App\Services\Auth;

use LaravelEasyRepository\BaseService;

interface AuthService extends BaseService{

    public function login($credentials);

    public function register($credentials);

    public function responseWithToken($token);
}
