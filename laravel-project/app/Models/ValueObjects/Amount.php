<?php

namespace App\Models\ValueObjects;

final class Amount
{
    private $value;

    public function __construct(float $value)
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException("Amount must be positive");
        }
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function __toString() {
        return (string)$this->getValue();
    }
}