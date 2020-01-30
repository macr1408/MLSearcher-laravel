<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserSettingsMlToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_settings', function ($table) {
            $table->string('ml_access_token', 50)->nullable()->default(null);
            $table->string('ml_refresh_token', 50)->nullable()->default(null);
            $table->dateTime('ml_token_expiry', 0)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
