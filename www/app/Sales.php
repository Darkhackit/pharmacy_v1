<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public function users() {

        return $this->hasMany(User::class);
    }

    public function sales_details() {

        return  $this->hasMany(Sales_Details::class);
    }
}
