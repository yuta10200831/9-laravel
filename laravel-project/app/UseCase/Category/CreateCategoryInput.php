<?php

namespace App\UseCase\Category;

class CreateCategoryInput
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

    public function all(): array
    {
        return [
            'name' => $this->getName(),
            'user_id' => $this->getUserId(),
        ];
    }
}