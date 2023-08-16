<?php

namespace App\services;

interface AuthService
{
    public function login($request);
    public function register($request);
    public function logout();
}
