<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/health', name: 'app_health_')]
final class HealthController extends AbstractController
{
    #[Route('/up', name: 'up')]
    public function index(): JsonResponse
    {
        return $this->json(['status'=> 'running']);
    }
}
