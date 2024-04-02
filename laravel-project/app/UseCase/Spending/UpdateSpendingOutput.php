<?php

namespace App\UseCase\Spending;

class UpdateSpendingOutput
{
    private $success;
    private $errors;

    public function __construct(bool $success, array $errors = [])
    {
        $this->success = $success;
        $this->errors = $errors;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}