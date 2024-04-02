<?php

namespace App\Models\ValueObjects;

class Name
{
    private $value;

    public function __construct(string $value)
    {
        if (empty($value) || strlen($value) > 255) {
            throw new \InvalidArgumentException("Name must be non-empty and up to 255 characters.");
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}