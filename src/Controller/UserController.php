<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use App\Dto\UserDto;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

final class UserController extends AbstractController
{

    public function __construct(private UserService $user_service) {
    }

    #[Route('/register', name: 'user_store', methods: ['POST'], format: 'json')]
    public function store(#[MapRequestPayload] UserDto $user_dto): JsonResponse
    {

        $this->user_service->store($user_dto);

        return $this->json(['message' => 'User was created with success'],Response::HTTP_CREATED);
    }
}
