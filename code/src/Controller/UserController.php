<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    #[Route('/', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->new($user, $request);

            return $this->render('user/created.html.twig', [
                'user' => $user
            ]);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/needs-confirmation/{mail}', name: 'user_needs-confirmation', methods: ['GET'])]
    public function needsConfirmation(Request $request, string $mail): Response
    {
        return $this->render('user/needs-confirmation.html.twig', [
            'mail' => $mail
        ]);
    }

    #[Route('/validate-account/{token}', name: 'user_validate', methods: ['GET'])]
    public function validate(string $token): Response
    {
        $isValidated = $this->service->validateAccount($token);

        return $this->render('user/validate-account.html.twig', [
            'isValidated' => $isValidated,
        ]);
    }

    #[Route('/reset-password', name: 'user_reset-password', methods: ['GET'])]
    public function resetPassword(): Response
    {
        return $this->render('user/reset-password.html.twig', [
            'isSent' => false
        ]);
    }

    #[Route('/reset-password', name: 'user_send-reset-password', methods: ['POST'])]
    public function sendResetPassword(Request $request): Response
    {
        $mail = $request->get('email');
        $this->service->sendResetPassword($mail);

        return $this->render('user/reset-password.html.twig', [
            'isSent' => true
        ]);
    }

    #[Route('/reset-password/{token}', name: 'user_verify-reset-password', methods: ['GET'])]
    public function verifyResetPassword(string $token): Response
    {
        $token = $this->service->verifyResetPassword($token);

        return $this->render('user/set-password.html.twig', [
            'token' => $token,
            'error' => null
        ]);
    }

    #[Route('/set-password', name: 'user_set-password', methods: ['GET', 'POST'])]
    public function setPassword(Request $request): Response
    {
        $error = $this->service->setPassword($request);

        if ($error !== null) {
            return $this->render('user/set-password.html.twig', [
                'token' => $request->get('token'),
                'error' => $error
            ]);
        } else {
            return $this->redirectToRoute('app_login', [
                'success' => true
            ]);
        }
    }
}
