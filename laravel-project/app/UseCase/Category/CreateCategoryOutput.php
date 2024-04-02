<?php

namespace App\UseCase\Category;

class CreateCategoryOutput
{
    private $success;
    private $category;
    private $errors;

    public function __construct(bool $success, $category = null, array $errors = [])
    {
        $this->success = $success;
        $this->category = $category;
        $this->errors = $errors;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}