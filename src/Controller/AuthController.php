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
        die(json_encode("ici"));exit();
        $data = json_decode($request->getContent(), true);

        if (!isset($data['username']) || !isset($data['password'])) {
            throw new HttpException(400, 'Missing username or password');
        }

        $username = $data['username'];
        $password = $data['password'];

        $user = $this->security->getUser();

        die(json_encode($user));exit();

        if (!$user instanceof UserInterface || !$this->userPasswordHasher->isPasswordValid($user, $password)) {
            throw new HttpException(401, 'Invalid credentials');
        }


        return new JsonResponse([
            'token' => $this->jwtManager->create($user),
            'username' => $user->getUsername()
        ]);
    }
}