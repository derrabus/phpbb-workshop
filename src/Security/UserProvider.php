<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private const USERLEVEL_MAP = [
        4 => 'ROLE_ADMIN',
        3 => 'ROLE_SUPER_MODERATOR',
        2 => 'ROLE_MODERATOR',
        1 => 'ROLE_USER'
    ];

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername($username)
    {
        /** @var \App\Entity\User $dbUser */
        $dbUser = $this->userRepository->findOneBy(['username' => $username]);
        if (null === $dbUser) {
            throw new UsernameNotFoundException();
        }

        return new User(
            $dbUser->getUsername(),
            $dbUser->getPassword(),
            [self::USERLEVEL_MAP[$dbUser->getLevel()] ?? 'ROLE_USER'],
            true,
            $dbUser->getLevel() > -1
        );
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return is_a($class, User::class, true);
    }
}
