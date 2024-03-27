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

    public function income_source()
    {
        return $this->belongsTo(IncomeSource::class, 'income_source_id');
    }

    public function incomeSource()
{
    return $this->belongsTo(IncomeSource::class);
}
}