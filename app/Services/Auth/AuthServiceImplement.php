<?php

namespace App\Services\Auth;

use App\Models\User;
use LaravelEasyRepository\ServiceApi;
use App\Repositories\Auth\AuthRepository;

class AuthServiceImplement extends ServiceApi implements AuthService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
     protected string $title = "";
     /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

    // Define your custom methods :)
    public function login($credentials)
    {
        try {
            if (! $token = auth()->attempt($credentials)) {
                return $this->setCode(401)
                    ->setMessage('Unauthorized');
            }

            return $this->setCode(200)
                ->setMessage('Login success')
                ->setResult($this->responseWithToken($token)->getResult());
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function register($credentials)
    {
        try {
            $user = User::create([
                'name'      => $credentials['name'],
                'email'     => $credentials['email'],
                'password'  => bcrypt($credentials['password'])
            ]);

            return $this->setCode(201)
                ->setMessage('Register success')
                ->setData($user);
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function responseWithToken($token)
    {
        return $this->setData([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1
        ]);
    }
}
