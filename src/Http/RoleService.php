<?php

namespace ErdinHrmwn\RocketChat\Http;

class RoleService extends ApiService
{
    public function list(): array
    {
        $response = $this->getRequest('/api/v1/roles.list');

        return $response['roles'];
    }

    public function create(string $name, ?string $description = null, ?string $scope = 'Users'): array
    {
        $response = $this->postRequest('/api/v1/roles.create', [
            'name' => $name,
            'scope' => $scope,
            'description' => $description,
        ]);

        return $response['role'];
    }

    public function update(string $roleId, string $name, ?string $description = null, ?string $scope = 'Users'): array
    {
        $response = $this->postRequest('/api/v1/roles.update', [
            'roleId' => $roleId,
            'name' => $name,
            'scope' => $scope,
            'description' => $description,
        ]);

        return $response['role'];
    }

    public function delete(string $roleId): bool
    {
        $response = $this->postRequest('/api/v1/roles.delete', [
            'roleId' => $roleId,
        ]);

        return (bool) $response['success'];
    }

    public function assignRole(string $roleName, string $username): array
    {
        $response = $this->postRequest('/api/v1/roles.addUserToRole', [
            'roleName' => $roleName,
            'username' => $username,
        ]);

        return $response['role'];
    }

    public function revokeRole(string $roleName, string $username): bool
    {
        $response = $this->postRequest('/api/v1/roles.removeUserFromRole', [
            'roleName' => $roleName,
            'username' => $username,
        ]);

        return (bool) $response['success'];
    }
}
