<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class LoginController
{
    private $authenticationUtils;
    private $twig;

    public function __construct(AuthenticationUtils $authenticationUtils, Environment $twig)
    {
        $this->authenticationUtils = $authenticationUtils;
        $this->twig = $twig;
    }

    /**
     * @Route("/login", name="login")
     */
    public function __invoke(): Response
    {
        // get the login error if there is one
        $error = $this->authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return new Response($this->twig->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]));
    }
}
