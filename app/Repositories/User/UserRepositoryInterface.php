<?php

namespace App\Repositories\User;

interface UserRepositoryInterface {
    public function getUserByUsernameOrEmail($username);
}