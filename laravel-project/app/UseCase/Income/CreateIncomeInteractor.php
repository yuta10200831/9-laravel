<?php

namespace App\UseCase\Income;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\ValueObjects\IncomeSourceId;
use App\Models\ValueObjects\Amount;
use App\Models\ValueObjects\AccrualDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CreateIncomeInteractor
{
    public function handle(CreateIncomeInput $input, int $userId, array $categoryIds): CreateIncomeOutput
    {
        $validator = Validator::make($input->all(), [
            'income_source_id' => 'required|integer',
            'amount' => 'required|numeric|min:0.01',
            'accrual_date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return new CreateIncomeOutput(false, $validator->errors()->toArray());
        }

        $income = Income::create([
            'income_source_id' => $input->getIncomeSourceId(),
            'amount' => $input->getAmount(),
            'accrual_date' => $input->getAccrualDate(),
            'user_id' => $userId,
        ]);

        $income->incomeCategories()->sync($categoryIds);

        return new CreateIncomeOutput(true, $income->id, ["収入が登録されました！"]);
    }
}