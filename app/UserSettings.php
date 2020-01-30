<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $fillable = ['user_id', 'allowed-locations', 'ml_client_id', 'ml_client_secret', 'ml_access_token', 'ml_refresh_token', 'ml_token_expiry'];
    public $timestamps = false;
}
