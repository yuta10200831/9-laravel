<?php

namespace App\UseCase\Spending;

use App\Models\Spending;
use Illuminate\Support\Collection;

class SpendingPageInteractor
{
    public function handle(?int $categoryId, ?string $startDate, ?string $endDate): Collection
    {
        $query = Spending::with('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($startDate) {
            $query->where('accrual_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('accrual_date', '<=', $endDate);
        }

        return $query->get();
    }
}