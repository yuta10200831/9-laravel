<?php

namespace App\UseCase\Spending;

final class CreateSpendingInput
{
    private $name;
    private $categoryId;
    private $amount;
    private $accrualDate;
    private $userId;

    public function __construct(string $name, int $categoryId, float $amount, string $accrualDate, int $userId)
    {
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->amount = $amount;
        $this->accrualDate = $accrualDate;
        $this->userId = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getAccrualDate(): string
    {
        return $this->accrualDate;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function all(): array
    {
        return [
            'name' => $this->getName(),
            'category_id' => $this->getCategoryId(),
            'amount' => $this->getAmount(),
            'accrual_date' => $this->getAccrualDate(),
            'user_id' => $this->getUserId(),
        ];
    }
}