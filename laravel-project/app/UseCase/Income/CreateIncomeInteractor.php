<?php

namespace App\UseCase\Income;

use App\Models\Income;
use App\Models\ValueObjects\IncomeSourceId;
use App\Models\ValueObjects\Amount;
use App\Models\ValueObjects\AccrualDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

final class CreateIncomeInteractor
{
    public function handle(CreateIncomeInput $input, $userId): CreateIncomeOutput
    {
        $validator = Validator::make($input->all(), [
            'income_source_id' => 'required|integer',
            'amount' => 'required|numeric|min:0.01',
            'accrual_date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return new CreateIncomeOutput(false, $validator->errors()->toArray());
        }

        Income::create([
         'income_source_id' => $input->getIncomeSourceId(),
         'amount' => $input->getAmount(),
         'accrual_date' => $input->getAccrualDate(),
         'user_id' => $userId,
     ]);

     return new CreateIncomeOutput(true, ["収入が登録されました！"]);
 }
}