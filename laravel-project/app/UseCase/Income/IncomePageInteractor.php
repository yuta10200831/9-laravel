<?php

namespace App\UseCase\Income;

use App\Models\Income;
use App\Models\IncomeSource;

class IncomePageInteractor
{
    public function handle(?int $incomeSourceId, ?string $startDate, ?string $endDate)
    {
        $query = Income::query();

        if (!is_null($incomeSourceId)) {
            $query->where('income_source_id', $incomeSourceId);
        }
        if (!is_null($startDate)) {
            $query->whereDate('accrual_date', '>=', $startDate);
        }
        if (!is_null($endDate)) {
            $query->whereDate('accrual_date', '<=', $endDate);
        }

        $incomes = $query->with('incomeSource')->get();
        $totalIncome = $incomes->sum('amount');
        $incomeSources = IncomeSource::all();

        return compact('incomes', 'totalIncome', 'incomeSources');
    }
}