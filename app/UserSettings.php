<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $fillable = ['user_id', 'allowed-locations', 'ml_access_token', 'ml_refresh_token', 'ml_token_expiry'];
    public $timestamps = false;
}
