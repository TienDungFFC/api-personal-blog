<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface {
    public function __construct(User $user) {
        parent::__construct($user);
    }

    public function getUserByUsernameOrEmail($username) {
        return $this->model->where('username', $username)->orWhere('email', $username)->first();
    }
}