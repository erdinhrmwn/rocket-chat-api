<?php

namespace ErdinHrmwn\RocketChat\Http;

class PermissionService extends ApiService
{
    public function list(): array
    {
        $response = $this->getRequest('/api/v1/permissions.listAll');

        return $response['update'];
    }

    public function updatePermission(string $permissionId, array $roles): array
    {
        $response = $this->postRequest('/api/v1/permissions.update', [
            'permissions' => [
                [
                    '_id' => $permissionId,
                    'roles' => $roles,
                ],
            ],
        ]);

        return $response['permissions'];
    }
}
