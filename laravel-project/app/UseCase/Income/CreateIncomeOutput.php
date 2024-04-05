<?php

namespace App\UseCase\Income;

final class CreateIncomeOutput
{
    private $isSuccess;
    private $messages;

    public function __construct(bool $isSuccess, $messages)
    {
        $this->isSuccess = $isSuccess;
        $this->messages = is_array($messages) ? $messages : [$messages];
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}