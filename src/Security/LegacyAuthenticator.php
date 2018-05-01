<?php

namespace App\Security;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class LegacyAuthenticator extends AbstractGuardAuthenticator
{
    private $em;
    private $sessionCookieName;
    private $sessionCookieTime;

    public function __construct(
        EntityManagerInterface $em,
        string $sessionCookieName,
        int $sessionCookieTime
    ) {
        $this->em = $em;
        $this->sessionCookieName = $sessionCookieName;
        $this->sessionCookieTime = $sessionCookieTime;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse('/login.php');
    }

    public function supports(Request $request)
    {
        return $request->cookies->has($this->sessionCookieName);
    }

    public function getCredentials(Request $request)
    {
        return $request->cookies->get($this->sessionCookieName);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        /** @var Session $session */
        $session = $this->em->find(Session::class, $credentials);
        if (null === $session) {
            throw new AuthenticationException();
        }

        $session->setStartTime(time());
        $this->em->flush();

        return $userProvider->loadUserByUsername($session->getUser()->getUsername());
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return null;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
