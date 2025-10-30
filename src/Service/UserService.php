<?php

namespace App\Service;

use App\Dto\UserDto;
use App\Repository\UserRepository;
use App\Resource\UserResource;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserService {

    public function __construct(
        private UserRepository $user_repository,
        private UserPasswordHasherInterface $password_hasher,
        private ObjectMapperInterface $mapper,
        private Security $security,
    ) {
    }

    public function store(UserDto $user_dto): void {
        $user = $this->mapper->map($user_dto); 

        $hashed_password = $this->password_hasher->hashPassword(
            $user,
            $user_dto->password
        );

        $user->setPassword($hashed_password);

        $this->user_repository->store($user);
    }

    public function currentUser(): UserResource{
        $user = $this->security->getUser();

        return $this->mapper->map($user, UserResource::class);
    }
}