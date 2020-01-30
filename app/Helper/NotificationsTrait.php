<?php

namespace App\Helper;

/**
 * NotificationsTrait
 */
trait NotificationsTrait
{
    /**
     * Flashes a success message into the session
     *
     * @param string $msg
     * @return void
     */
    public static function flash_success(string $msg): void
    {
        session()->flash('notifications', [
            'success' => $msg
        ]);
    }

    /**
     * Flashes an error message into the session
     *
     * @param string $msg
     * @return void
     */
    public static function flash_error(string $msg): void
    {
        session()->flash('notifications', [
            'error' => $msg
        ]);
    }

    /**
     * Flashes an info message into the session
     *
     * @param string $msg
     * @return void
     */
    public static function flash_info(string $msg): void
    {
        session()->flash('notifications', [
            'info' => $msg
        ]);
    }

    private static function flash(string $type, string $msg): void
    {
        $notifications = session('notifications');
        $notifications[] = [$type => $msg];
        session()->flash('notifications', $notifications);
    }
}
