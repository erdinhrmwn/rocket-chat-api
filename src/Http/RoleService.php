<?php

namespace ErdinHrmwn\RocketChat\Http;

use ErdinHrmwn\RocketChat\Entities\Role;
use ErdinHrmwn\RocketChat\Entities\User;

class RoleService extends ApiService
{
    /**
     * @return array<Role>
     */
    public function list(): array
    {
        $response = $this->getRequest('/api/v1/roles.list');

        return array_map(fn (array $role): Role => Role::fromArray($role), $response['roles']);
    }

    /**
     * @return array<User>
     */
    public function getUsers(string $id): array
    {
        $response = $this->getRequest('/api/v1/roles.getUsersInRole', ['roleId' => $id]);

        return array_map(fn (array $user): User => User::fromArray($user), $response['users']);
    }

    public function create(string $name, string $description, ?string $scope = 'Users'): Role
    {
        $response = $this->postRequest('/api/v1/roles.create', [
            'name' => $name,
            'scope' => $scope,
            'description' => $description,
        ]);

        return Role::fromArray($response['role']);
    }

    public function update(string $id, string $name, string $description, ?string $scope = 'Users'): Role
    {
        $response = $this->postRequest('/api/v1/roles.update', [
            'roleId' => $id,
            'name' => $name,
            'scope' => $scope,
            'description' => $description,
        ]);

        return Role::fromArray($response['role']);
    }

    public function delete(string $id): bool
    {
        $response = $this->postRequest('/api/v1/roles.delete', ['roleId' => $id]);

        return (bool) $response['success'];
    }

    public function assignRole(string $role, string $userId): Role
    {
        $response = $this->postRequest('/api/v1/roles.addUserToRole', [
            'roleName' => $role,
            'username' => $userId,
        ]);

        return Role::fromArray($response['role']);
    }

    public function revokeRole(string $id, string $userId): bool
    {
        $response = $this->postRequest('/api/v1/roles.removeUserFromRole', [
            'roleId' => $id,
            'username' => $userId,
        ]);

        return (bool) $response['success'];
    }
}
