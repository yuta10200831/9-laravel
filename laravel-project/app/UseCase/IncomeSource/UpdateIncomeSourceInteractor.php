<?php

namespace App\UseCase\IncomeSource;

use App\Models\IncomeSource;
use Illuminate\Support\Facades\Validator;

class UpdateIncomeSourceInteractor
{
    public function handle(UpdateIncomeSourceInput $input): UpdateIncomeSourceOutput
    {
        $validator = Validator::make([
            'name' => $input->getName(),
        ], [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return new UpdateIncomeSourceOutput(false, $validator->errors()->toArray());
        }

        $incomeSource = IncomeSource::findOrFail($input->getId());
        $incomeSource->update(['name' => $input->getName()]);

        return new UpdateIncomeSourceOutput(true);
    }
}