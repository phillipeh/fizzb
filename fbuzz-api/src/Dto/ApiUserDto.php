<?php

// only created for scalability purposes

namespace App\Dto;

use App\Entity\ApiUser;

class ApiUserDto
{
    public function __construct(
        public readonly string $username,
        public readonly array $roles
    ) {}

    public static function fromEntity(ApiUser $user): self
    {
        return new self(
            $user->getUsername(),
            $user->getRoles()
        );
    }
}
