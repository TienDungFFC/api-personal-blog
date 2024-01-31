<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {
    }

    public function login(Request $request) {
        try {
            $userNameOrEmail = $request->username;
            $password = $request->password;
            return response()->json($this->authService->login($userNameOrEmail, $password)->toArray());
        } catch (\Exception $e) {
            abort(Response::HTTP_UNAUTHORIZED, 'Invalid credentials');
        }
    }
}
