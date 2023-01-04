<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    public function expense() {

        return $this->belongsTo(Expense::class,'payment_id');
    }
}
