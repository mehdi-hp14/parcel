<?php

namespace Kaban\Models;

use Illuminate\Database\Eloquent\Model;

class MailConfig extends Model
{

//    protected $guarded = ['id'];
    protected $fillable = [
        'driver',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_address',
        'to_address',
    ];
}
