<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{

    public function expen() {

        return $this->belongsTo(Expense::class,'expense_category_id');
    }
}
