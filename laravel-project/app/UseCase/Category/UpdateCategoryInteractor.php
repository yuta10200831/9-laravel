<?php

namespace App\UseCase\Category;

use App\Models\Category;
use App\Models\ValueObjects\Name;
use Illuminate\Support\Facades\Validator;

class UpdateCategoryInteractor
{
    public function handle(UpdateCategoryInput $input): UpdateCategoryOutput
    {
        $validator = Validator::make($input->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $input->getId(),
        ]);

        if ($validator->fails()) {
            return new UpdateCategoryOutput(false, $validator->errors()->toArray());
        }

        $category = Category::findOrFail($input->getId());
        $name = new Name($input->getName());
        $category->name = $name->getValue();
        $category->save();

        return new UpdateCategoryOutput(true);
    }
}