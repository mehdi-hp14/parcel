<?php

namespace Kaban\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{

    protected $table = 'urls';

    protected $guarded = ['id'];

    public function agent()
    {
        return $this->belongsTo(Agent::class,'aref');
    }

}
