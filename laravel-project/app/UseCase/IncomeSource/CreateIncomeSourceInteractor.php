<?php

namespace App\UseCase\IncomeSource;

use App\Models\IncomeSource;
use Illuminate\Support\Facades\Validator;

class CreateIncomeSourceInteractor
{
    public function handle(CreateIncomeSourceInput $input): CreateIncomeSourceOutput
    {
        $validator = Validator::make([
            'name' => $input->getName(),
            'user_id' => $input->getUserId(),
        ], [
            'name' => 'required|string|max:255',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return new CreateIncomeSourceOutput(false, $validator->errors()->toArray());
        }

        $incomeSource = IncomeSource::create([
            'name' => $input->getName(),
            'user_id' => $input->getUserId(),
        ]);

        return new CreateIncomeSourceOutput(true, $incomeSource);
    }
}