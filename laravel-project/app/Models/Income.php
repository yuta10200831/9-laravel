<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'income_source_id', 'amount', 'accrual_date', 'user_id'
    ];

    protected $dates = ['accrual_date'];

    public function incomeSource()
    {
        return $this->belongsTo(IncomeSource::class);
    }

    public function incomeCategories()
    {
        return $this->belongsToMany(IncomeCategory::class, 'incomes_xref_income_categories', 'income_id', 'income_category_id');
    }
}