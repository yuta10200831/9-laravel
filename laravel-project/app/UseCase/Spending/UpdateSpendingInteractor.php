<?php

namespace App\UseCase\Spending;

use App\Models\Spending;
use Illuminate\Support\Facades\Validator;
use App\UseCase\Spending\UpdateSpendingOutput;
use App\UseCase\Spending\UpdateSpendingInput;

class UpdateSpendingInteractor
{
    public function handle(UpdateSpendingInput $input): UpdateSpendingOutput
    {
        $validator = Validator::make($input->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'amount' => 'required|numeric|min:0.01',
            'accrual_date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return new UpdateSpendingOutput(false, $validator->errors()->toArray());
        }

        $spending = Spending::findOrFail($input->getId());
        $spending->update($input->all());

        return new UpdateSpendingOutput(true);
    }
}