<?php

namespace App\UseCase\IncomeSource;

class CreateIncomeSourceOutput
{
    private $success;
    private $incomeSource;
    private $errors;

    public function __construct(bool $success, $incomeSource = null, array $errors = [])
    {
        $this->success = $success;
        $this->incomeSource = $incomeSource;
        $this->errors = $errors;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getIncomeSource()
    {
        return $this->incomeSource;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}