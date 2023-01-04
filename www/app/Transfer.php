<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{

    public function shops_1()
    {
        return $this->belongsTo(Shop::class , 'from');
    }

    public function shops_2()
    {
        return $this->belongsTo(Shop::class , 'to');
    }

}
