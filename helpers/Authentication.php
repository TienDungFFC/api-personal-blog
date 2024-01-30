<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Authentication {
    const SIGNATURE_ALGO = 'EdDSA';
    const EXPIRE_TOKEN = 86400;
    const EXPIRE_REFRESH_TOKEN = 172800;

    private $privateKey;

    private $publicKey;

    private $keyPair;

    private $accessToken;

    private $refreshToken;

    private function setKeyPair() {
        $this->keyPair = sodium_crypto_sign_keypair();
    }

    public function getKeyPair() {
        return $this->keyPair;
    }

    private function setPrivateKey() {
        $this->privateKey = base64_encode(sodium_crypto_sign_secretkey($this->keyPair));
    }

    private function setPublicKey() {
        $this->publicKey = base64_encode(sodium_crypto_sign_publickey($this->keyPair));
    }

    private function createToken($userId, $exp = self::EXPIRE_TOKEN) {
        $payload = [
            'iat' => now(),
            'exp' => now() + $exp,
            'user_id' => $userId,
        ];
        
        return JWT::encode($payload, $this->privateKey, self::SIGNATURE_ALGO);
    }

    public function setToken($userId) {
        setAccessToken($userId);
        setRefreshToken($userId);
    }

    public function setAccessToken($userId) {
        $this->accessToken = $this->createToken($userId);
    }

    public function setRefreshToken($userId) {
        $this->refreshToken = $this->createToken($userId, self::EXPIRE_REFRESH_TOKEN);
    }

    public function getAccessToken() {
        return $this->accessToken;
    }

    public function getRefreshToken() {
        return $this->refreshToken;
    }
}