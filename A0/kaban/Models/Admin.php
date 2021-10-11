<?php

namespace Kaban\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kaban\General\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
//        'remember_token',
    ];

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
