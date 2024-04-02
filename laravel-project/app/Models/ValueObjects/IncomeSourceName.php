<?php

namespace App\ValueObjects;

class IncomeSourceName
{
    private $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty.');
        }
        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->name;
    }
}