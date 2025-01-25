<?php

namespace ErdinHrmwn\RocketChat\Entities;

class Role
{
    private string $id;

    private string $name;

    private array $scope = [];

    private string $description;

    private bool $protected = true;

    private bool $mandatory2fa = false;

    private ?string $updateAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Role
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Role
    {
        $this->name = $name;
        return $this;
    }

    public function getScope(): array
    {
        return $this->scope;
    }

    public function setScope(array $scope = []): Role
    {
        $this->scope = $scope;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Role
    {
        $this->description = $description;
        return $this;
    }

    public function isProtected(): bool
    {
        return $this->protected;
    }

    public function setProtected(bool $protected): Role
    {
        $this->protected = $protected;
        return $this;
    }

    public function isMandatory2fa(): bool
    {
        return $this->mandatory2fa;
    }

    public function setMandatory2fa(bool $mandatory2fa): Role
    {
        $this->mandatory2fa = $mandatory2fa;
        return $this;
    }

    public function getUpdateAt(): ?string
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?string $updateAt): Role
    {
        $this->updateAt = $updateAt;
        return $this;
    }

    public static function fromArray(array $data): Role
    {
        $role = new Role;
        $role->setId($data['_id']);
        $role->setName($data['name']);
        $role->setScope($data['scope']);
        $role->setDescription($data['description']);
        $role->setProtected($data['protected']);
        $role->setMandatory2fa($data['mandatory2fa']);
        $role->setUpdateAt($data['_updatedAt'] ?? null);

        return $role;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'scope' => $this->getScope(),
            'mandatory2fa' => $this->isMandatory2fa(),
            'protected' => $this->isProtected(),
            'updatedAt' => $this->getUpdateAt(),
        ];
    }

    public function toJson(): object
    {
        return (object) $this->toArray();
    }
}
