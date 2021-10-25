<?php

namespace Kaban\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kaban\General\Enums\EAdminRank;
use Kaban\General\Enums\EAdminStatus;
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

    public function getRankEnAttribute()
    {
        return EAdminRank::farsi($this->rank);
    }
    public function getStatusEnAttribute()
    {
        return EAdminStatus::farsi($this->status);
    }
}
