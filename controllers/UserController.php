<?php


namespace controllers;

use models\User;

class UserController
{
    private $userModel;
    public function __construct(User $user)
    {
        $this->userModel = $user;
    }
    // Métodos para manejar acciones del usuario (registro, login, etc.)
}
