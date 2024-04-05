<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;

    protected $table = 'income_categories';

    protected $fillable = ['name'];

    public function incomes()
    {
        return $this->belongsToMany(Income::class, 'incomes_xref_income_categories', 'income_category_id', 'income_id');
    }
}