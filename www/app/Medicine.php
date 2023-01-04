<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    //

    public function category() {

        return $this->belongsTo(Category::class);
    }

    public function suppliers() {

        return $this->belongsTo(Supplier::class);
    }

    public function manufacturers() {

        return $this->belongsTo(Manufacturer::class);
    }

    public function medicine_type() {

        return $this->belongsTo(MedicineType::class);
    }
    public function unit() {

        return $this->belongsTo(Unit::class);
    }
}
