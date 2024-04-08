<?php

namespace App\UseCase\Income;

use App\Models\Income;
use App\Models\IncomeSource;
use App\Models\IncomeCategory;

class IncomePageInteractor
{
    public function handle(?int $incomeSourceId, ?string $startDate, ?string $endDate, ?int $incomeCategoryId)
    {
        $query = Income::query();

        if (!is_null($incomeSourceId)) {
            $query->where('income_source_id', $incomeSourceId);
        }
        if (!is_null($incomeCategoryId)) {
            $query->whereHas('incomeCategories', function ($q) use ($incomeCategoryId) {
                $q->where('income_categories.id', $incomeCategoryId);
            });
        }
        if (!is_null($startDate)) {
            $query->whereDate('accrual_date', '>=', $startDate);
        }
        if (!is_null($endDate)) {
            $query->whereDate('accrual_date', '<=', $endDate);
        }

        $incomes = $query->with(['incomeSource', 'incomeCategories'])->get();
        $totalIncome = $incomes->sum('amount');
        $incomeSources = IncomeSource::all();
        $incomeCategories = IncomeCategory::all();

        return compact('incomes', 'totalIncome', 'incomeSources', 'incomeCategories');
    }
}