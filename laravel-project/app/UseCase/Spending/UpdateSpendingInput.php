<?php

namespace App\UseCase\Spending;

class UpdateSpendingInput
{
    private $id;
    private $name;
    private $categoryId;
    private $amount;
    private $accrualDate;

    public function __construct(int $id, string $name, int $categoryId, float $amount, string $accrualDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;
        $this->amount = $amount;
        $this->accrualDate = $accrualDate;
    }

    public function getId(): int
    {
        return $this->id;
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

    public function all(): array
    {
        return [
            'name' => $this->getName(),
            'category_id' => $this->getCategoryId(),
            'amount' => $this->getAmount(),
            'accrual_date' => $this->getAccrualDate(),
        ];
    }
}