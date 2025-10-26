<?php

namespace App\Dto;

use App\Entity\User;
use Symfony\Component\ObjectMapper\Attribute\Map;
use Symfony\Component\Validator\Constraints as Assert;

#[Map(target: User::class)]
final class UserDto {
    #[Assert\NotBlank(
        message: 'The name cannot be empty.'
    )]
    public string $name = '';
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.'
    )]
    public string $email = '';
    public ?string $password = null;
}