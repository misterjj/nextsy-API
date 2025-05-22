<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthController extends AbstractController
{

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher,
                                private JWTTokenManagerInterface $jwtManager,
                                private Security $security){

    }

    public function __invoke(Request $request): JsonResponse
    {
    }
}