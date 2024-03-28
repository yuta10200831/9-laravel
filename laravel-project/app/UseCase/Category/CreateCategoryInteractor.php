<?php

namespace App\UseCase\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CreateCategoryInteractor
{
    public function handle(CreateCategoryInput $input): CreateCategoryOutput
    {
        $validator = Validator::make($input->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return new CreateCategoryOutput(false, $validator->errors()->toArray());
        }

        $category = new Category([
            'name' => $input->getName(),
            'user_id' => $input->getUserId(),
        ]);
        $category->save();

        return new CreateCategoryOutput(true, $category);
    }
}