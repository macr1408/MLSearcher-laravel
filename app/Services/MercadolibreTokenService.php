<?php

namespace App\Services;

use App\Sdk\MercadolibreSdk;
use App\UserSettings;
use Carbon\Carbon;

class MercadolibreTokenService
{
    private $sdk;

    public function __construct(MercadolibreSdk $mlsdk)
    {
        $this->sdk = $mlsdk;
    }

    public function get_access_token(int $userId): string
    {
        $this->maybe_update_access_token($userId);
        $userSettings = UserSettings::where('user_id', '=', $userId)->firstOrFail();
        return $userSettings->ml_access_token;
    }

    public function maybe_update_access_token(int $userId): string
    {
        $userSettings = UserSettings::where('user_id', '=', $userId)->firstOrFail();
        if (Carbon::now() >= $userSettings->ml_token_expiry) {
            return $this->refresh_access_token($userId, $userSettings->ml_refresh_token);
        }
        return true;
    }

    public function update_access_token(int $userId, string $mlCode): bool
    {
        $authCall = $this->sdk->auth($mlCode, route('settings_authorize'));
        if (empty($authCall['access_token'])) {
            return false;
        }
        UserSettings::where('user_id', '=', $userId)->update(
            [
                'ml_access_token' => $authCall['access_token'],
                'ml_refresh_token' => $authCall['refresh_token'],
                'ml_token_expiry' =>  Carbon::now()->add('second', $authCall['expires_in']),
            ]
        );
        return true;
    }

    protected function refresh_access_token(int $userId, string $refreshToken): bool
    {
        $refreshCall = $this->sdk->refreshToken($refreshToken);
        if (empty($refreshCall['access_token'])) {
            return false;
        }
        UserSettings::where('user_id', '=', $userId)->update(
            [
                'ml_access_token' => $refreshCall['access_token'],
                'ml_refresh_token' => $refreshCall['refresh_token'],
                'ml_token_expiry' =>  Carbon::now()->add('second', $refreshCall['expires_in']),
            ]
        );
        return true;
    }
}
