<?php

namespace App\Security;

use Pimcore\Model\DataObject\WebsiteUser\Listing as WebsiteUserListing;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;



class WebsiteUserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function loadUserByIdentifier(string $email): UserInterface
    {
        $listing = new WebsiteUserListing();
        $listing->setCondition('email = ?', [$email]);
        $user = $listing->load();

        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Email not foundd.');
        }

        if (!$user[0]->getEmailVerified()) {
            throw new CustomUserMessageAuthenticationException('You must verify your email before logging in.');
        }

        return new WebsiteUserAdapter($user[0]);
    }

    // Symfony <5 compatibility (optional but safe)
    public function loadUserByUsername(string $username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof WebsiteUserAdapter) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return $class === WebsiteUserAdapter::class;
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof WebsiteUserAdapter) {
            return; // or throw exception if needed
        }

        $websiteUser = $user->getUserObject();
        $websiteUser->setPassword($newHashedPassword);
        $websiteUser->save();

        //$user->setPassword($newHashedPassword);
        //$this->entityManager->flush();
    }
}
