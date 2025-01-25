<?php

namespace ErdinHrmwn\RocketChat\Entities;

class User
{
    private string $id;

    private string $username;

    private ?string $password;

    private string $name;

    private string $email;

    /**
     * @var array<string>
     */
    private array $emails = [];

    private ?string $nickname;

    private ?string $bio;

    /**
     * @var array<string>
     */
    private array $roles = ['user'];

    private bool $active;

    private bool $verified;

    private bool $requirePasswordChange;

    private bool $setRandomPassword;

    private bool $sendWelcomeEmail;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): User
    {
        $this->id = $id;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * @param  array<string>  $emails
     */
    public function setEmails(array $emails): User
    {
        $this->emails = $emails;
        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): User
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): User
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param  array<string>  $roles
     */
    public function setRoles(array $roles = ['user']): User
    {
        $this->roles = $roles;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): User
    {
        $this->active = $active;
        return $this;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): User
    {
        $this->verified = $verified;
        return $this;
    }

    public function isRequirePasswordChange(): bool
    {
        return $this->requirePasswordChange;
    }

    public function setRequirePasswordChange(bool $requirePasswordChange): User
    {
        $this->requirePasswordChange = $requirePasswordChange;
        return $this;
    }

    public function isSetRandomPassword(): bool
    {
        return $this->setRandomPassword;
    }

    public function setSetRandomPassword(bool $setRandomPassword): User
    {
        $this->setRandomPassword = $setRandomPassword;
        return $this;
    }

    public function isSendWelcomeEmail(): bool
    {
        return $this->sendWelcomeEmail;
    }

    public function setSendWelcomeEmail(bool $sendWelcomeEmail): User
    {
        $this->sendWelcomeEmail = $sendWelcomeEmail;
        return $this;
    }

    public static function fromArray(array $data): User
    {
        $user = new User;
        $user->setId($data['_id']);
        $user->setUsername($data['username']);
        $user->setPassword($data['password']);
        $user->setName($data['name']);
        $user->setEmail($data['emails'][0]['address']);
        $user->setEmails($data['emails']);
        $user->setNickname($data['nickname']);
        $user->setBio($data['bio']);
        $user->setRoles($data['roles']);
        $user->setActive($data['active']);
        $user->setVerified($data['emails'][0]['verified']);
        $user->setRequirePasswordChange($data['requirePasswordChange']);
        $user->setSetRandomPassword($data['setRandomPassword']);
        $user->setSendWelcomeEmail($data['sendWelcomeEmail']);

        return $user;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'emails' => $this->getEmails(),
            'nickname' => $this->getNickname(),
            'bio' => $this->getBio(),
            'roles' => $this->getRoles(),
            'active' => $this->isActive(),
            'verified' => $this->isVerified(),
            'requirePasswordChange' => $this->isRequirePasswordChange(),
            'setRandomPassword' => $this->isSetRandomPassword(),
            'sendWelcomeEmail' => $this->isSendWelcomeEmail(),
        ];
    }

    public function toJson(): object
    {
        return (object) $this->toArray();
    }
}
