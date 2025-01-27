<?php

namespace ErdinHrmwn\RocketChat\Http;

class RoleService extends ApiService
{
    public function list(): array
    {
        $response = $this->getRequest('/api/v1/roles.list');

        return $response['roles'];
    }

    public function create(string $name, string $description = '', ?string $scope = 'Users'): array
    {
        $response = $this->postRequest('/api/v1/roles.create', [
            'name' => $name,
            'scope' => $scope,
            'description' => $description,
        ]);

        return $response['role'];
    }

    public function update(string $id, string $name, string $description = '', ?string $scope = 'Users'): array
    {
        $response = $this->postRequest('/api/v1/roles.update', [
            'roleId' => $id,
            'name' => $name,
            'scope' => $scope,
            'description' => $description,
        ]);

        return $response['role'];
    }

    public function delete(string $id): bool
    {
        $response = $this->postRequest('/api/v1/roles.delete', ['roleId' => $id]);

        return (bool) $response['success'];
    }

    public function assignRole(string $role, string $user, string $paramType = 'userId'): array
    {
        $response = $this->postRequest('/api/v1/roles.addUserToRole', [
            'roleName' => $role,
            $paramType => $user,
        ]);

        return $response['role'];
    }

    public function revokeRole(string $id, string $user, string $paramType = 'userId'): bool
    {
        $response = $this->postRequest('/api/v1/roles.removeUserFromRole', [
            'roleId' => $id,
            $paramType => $user,
        ]);

        return (bool) $response['success'];
    }
}
