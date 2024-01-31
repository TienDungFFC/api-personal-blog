<?php 

namespace App\Services;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Authentication;
use App\Services\TokenManager;
use App\Exceptions\InvalidCredentialsException;
use App\Models\User;

class AuthService {
    public function __construct(
        private UserRepository $userRepository, 
        private TokenManager $tokenManger
    ) {
    }

    public function login($username, $password) {
        $user = $this->userRepository->getUserByUsernameOrEmail($username);
        if (!$user || !$this->passwordIsCorrect($password, $user->password)) {
            throw new InvalidCredentialsException();
        }
        return $this->tokenManger->createToken($user, ['*'], now()->addWeek());
    }

    public function passwordIsCorrect($password, $hashedPassword) {
        return Hash::check($password, $hashedPassword);
    }
}