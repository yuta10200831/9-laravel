<?php

namespace App\UseCase;

use App\Models\Income;
use App\Models\Spending;

class IndexInteractor
{
    public function handle(int $selectedYear): array
    {
        $fixed_data = [];
        for ($month = 1; $month <= 12; $month++) {
            $total_income = Income::whereYear('accrual_date', $selectedYear)
                                  ->whereMonth('accrual_date', $month)
                                  ->sum('amount');
            $total_spend = Spending::whereYear('accrual_date', $selectedYear)
                                   ->whereMonth('accrual_date', $month)
                                   ->sum('amount');

            $fixed_data[] = [
                'month' => $month . '月',
                'total_income' => $total_income,
                'total_spend' => $total_spend
            ];
        }

        $years = range(date('Y'), date('Y') - 10);

        return [
            'fixed_data' => $fixed_data,
            'years' => $years,
            'selectedYear' => $selectedYear
        ];
    }
}