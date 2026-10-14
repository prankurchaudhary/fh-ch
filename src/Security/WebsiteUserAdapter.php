<?php

namespace App\Security;

use Pimcore\Model\DataObject\WebsiteUser as WebsiteUserObject;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class WebsiteUserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    private WebsiteUserObject $userObj;

    public function __construct(WebsiteUserObject $userObj)
    {
        $this->userObj = $userObj;
    }

    public function getUserObject(): WebsiteUserObject
    {
        return $this->userObj;
    }

    public function getUserIdentifier(): string
    {
        return $this->userObj->getEmail();
    }

    public function getRoles(): array
    {
        $roles = $this->userObj->getRoles() ?: [];
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function getPassword(): ?string
    {
        return $this->userObj->getPassword();
    }

    public function getSalt(): ?string
    {
        return null; // modern hashers include salt
    }

    public function eraseCredentials(): void
    {
        // nothing to erase
    }
    public function isEmailVerified(): bool
    {
        return $this->userObj->getEmailVerified() === true;
    }
}
