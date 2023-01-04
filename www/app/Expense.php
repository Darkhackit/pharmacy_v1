<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    public function payments() {

        return $this->hasMany(Payment::class);
    }

    public function expense_categories() {

        return $this->hasMany(ExpenseCategory::class);
    }
}
