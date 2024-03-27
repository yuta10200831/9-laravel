<?php

namespace App\Models\ValueObjects;

final class AccrualDate
{
    private $value;

    public function __construct(string $value)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $value);
        if (!$date || $date->format('Y-m-d') !== $value) {
            throw new \InvalidArgumentException("Invalid accrual date format, expected Y-m-d");
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString() {
        return $this->getValue();
    }
}