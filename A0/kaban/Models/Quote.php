<?php

namespace Kaban\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Quote extends Model
{
    use Notifiable;

    protected $table = 'quote';

    protected $guarded = ['id'];

    public function getAirlineAttribute()
    {
        $airline = '';

        if(!empty($this->offered_p))
        {
            $tmp = explode(" | ",$this->offered_p);
            foreach($tmp as $v)
            {
                if($v!='')
                {
                    $t = explode(") ",$v);
                    $tt = explode("=>",$t[1]);
                    if($tt[0]=='on')
                    {
                        $airline = $tt[1];
                        break;
                    }
                }
            }
        }
        return $airline;
    }

    public function shipInfos()
    {
        return $this->hasMany(ShipInfo::class,'ref');
    }


    public function urls()
    {
        return $this->hasMany(Url::class,'ref');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'uname','uname');
    }
}
