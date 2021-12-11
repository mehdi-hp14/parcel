<?php

namespace Kaban\Models;

use Illuminate\Database\Eloquent\Model;

class ShipInfo extends Model
{
    protected $table = 'ship_info';

    public $timestamps = false;

    protected $guarded = ['id'];
}
