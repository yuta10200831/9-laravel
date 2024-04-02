<?php

namespace App\UseCase\Spending;

class CreateSpendingOutput
{
    private $success;
    private $spending;
    private $errors;

    public function __construct(bool $success, $spending = null, array $errors = [])
    {
        $this->success = $success;
        $this->spending = $spending;
        $this->errors = $errors;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getSpending()
    {
        return $this->spending;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}