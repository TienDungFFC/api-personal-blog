<?php 

namespace App\Services;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Authentication;

class TokenManager {
    
    public function createToken($user, $abilities = ['*'], $exp) {
        return $user->createToken(config('app.name'), $abilities, $exp);
    }
}