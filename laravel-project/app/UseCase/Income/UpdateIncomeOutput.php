<?php

namespace App\UseCase\Income;

final class UpdateIncomeOutput
{
    private $isSuccess;
    private $messages;

    public function __construct(bool $isSuccess, $messages)
    {
        $this->isSuccess = $isSuccess;
        $this->messages = $messages;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}