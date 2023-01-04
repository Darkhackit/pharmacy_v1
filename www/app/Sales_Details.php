<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_Details extends Model
{
    protected $table = 'sales_details';

    public function sale() {

        return $this->belongsTo(Sales::class);
    }
}
