<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'amount', 'accrual_date', 'user_id'];
    protected $dates = ['accrual_date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}