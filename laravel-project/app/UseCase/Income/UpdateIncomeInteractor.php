<?php

namespace App\UseCase\Income;

use App\Models\Income;
use Illuminate\Support\Facades\Validator;

final class UpdateIncomeInteractor
{
    public function handle(UpdateIncomeInput $input, int $incomeId): UpdateIncomeOutput
    {
        $validator = Validator::make([
            'income_source_id' => $input->getIncomeSourceId(),
            'amount' => $input->getAmount(),
            'accrual_date' => $input->getAccrualDate(),
        ], [
            'income_source_id' => 'required|integer',
            'amount' => 'required|numeric|min:0.01',
            'accrual_date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return new UpdateIncomeOutput(false, $validator->errors()->toArray());
        }

        $income = Income::findOrFail($incomeId);
        $income->update($validator->validated());

        return new UpdateIncomeOutput(true, "収入が更新されました！");
    }
}