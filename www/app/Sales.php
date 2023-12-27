<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sales extends Model
{
    public function users(): HasMany
    {

        return $this->hasMany(User::class);
    }

    public function sales_details(): HasMany
    {

        return  $this->hasMany(Sales_Details::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
