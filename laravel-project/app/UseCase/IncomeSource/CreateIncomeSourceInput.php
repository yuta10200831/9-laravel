<?php

namespace App\UseCase\IncomeSource;

class CreateIncomeSourceInput
{
    private $name;
    private $userId;

    public function __construct(string $name, int $userId)
    {
        $this->name = $name;
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}