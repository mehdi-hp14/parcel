<?php

namespace Kaban\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quote';
    public $timestamps = false;
    protected $guarded = ['id'];

}
