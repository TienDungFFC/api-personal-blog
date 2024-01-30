<?php 

namespace App\Services;

use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login(array $loginRequest) {
        $username = $loginRequest['username'] ?? '';
        $password = $loginRequest['password'] ?? '';
        $user = $this->userRepository->getUserByUsernameOrEmail($username);
        if (!$user) {
            return null;
        }
        $hashedPassword = $user->password;
        if ($this->passwordIsCorrect($password, $hashedPassword)) {
            return [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => now()->addWeek()->toDateTimeString(),
            ];
        }
        return null;
    }

    public function passwordIsCorrect($password, $hashedPassword) {
        return Hash::check($password, $hashedPassword);
    }
}