<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineType extends Model
{
    public function medicines() {

        return $this->hasMany(Medicine::class);
    }
}
