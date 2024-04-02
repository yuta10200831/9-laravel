<?php

namespace App\UseCase\Spending;

use App\Models\Spending;
use App\Models\ValueObjects\Name;
use App\Models\ValueObjects\Amount;
use App\Models\ValueObjects\AccrualDate;
use Illuminate\Support\Facades\Validator;

class CreateSpendingInteractor
{
    public function handle(CreateSpendingInput $input): CreateSpendingOutput
    {
        $validator = Validator::make($input->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'accrual_date' => 'required|date_format:Y-m-d',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return new CreateSpendingOutput(false, $validator->errors()->toArray());
        }

        $name = new Name($input->getName());
        $amount = new Amount($input->getAmount());
        $accrualDate = new AccrualDate($input->getAccrualDate());

        $spending = Spending::create([
            'name' => $name->getValue(),
            'category_id' => $input->getCategoryId(),
            'amount' => $amount->getValue(),
            'accrual_date' => $accrualDate->getValue(),
            'user_id' => $input->getUserId(),
        ]);

        return new CreateSpendingOutput(true, $spending);
    }
}