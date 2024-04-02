<?php

namespace App\UseCase\Income;

final class UpdateIncomeInput
{
    private $incomeSourceId;
    private $amount;
    private $accrualDate;

    public function __construct(int $incomeSourceId, float $amount, string $accrualDate)
    {
        $this->incomeSourceId = $incomeSourceId;
        $this->amount = $amount;
        $this->accrualDate = $accrualDate;
    }

    public function getIncomeSourceId(): int
    {
        return $this->incomeSourceId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAccrualDate(): string
    {
        return $this->accrualDate;
    }
}