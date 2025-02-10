<?php

namespace ErdinHrmwn\RocketChat\Http;

class UserService extends ApiService
{
    public function all(): array
    {
        $response = $this->getRequest('/api/v1/users.list', [
            'count' => 999999,
        ]);

        return $response['users'];
    }

    public function getList($params = []): array
    {
        $response = $this->getRequest('/api/v1/users.list', $params);

        return $response['users'];
    }

    public function getInfo(string $userId, string $paramType = 'userId'): array
    {
        if (!in_array($paramType, ['userId', 'username'])) {
            throw new \Exception('Bad method parameter value.');
        }

        if (!$userId) {
            throw new \Exception('User ID not specified.');
        }

        $response = $this->getRequest('/api/v1/users.info', [
            $paramType => $userId,
        ]);

        return $response['user'];
    }

    public function create(array $data): array
    {
        $response = $this->postRequest('/api/v1/users.create', $data);

        return $response['user'];
    }

    public function update(string $userId, array $userData): array
    {
        $response = $this->postRequest('/api/v1/users.update', [
            'userId' => $userId,
            'data' => $userData,
        ]);

        return $response['user'];
    }

    public function delete(string $userId): bool
    {
        $response = $this->postRequest('/api/v1/users.delete', [
            'userId' => $userId,
        ]);

        return (bool) $response['success'];
    }

    public function createToken(string $userId, string $paramType = 'userId'): array
    {
        if (!in_array($paramType, ['userId', 'username'])) {
            throw new \Exception('Bad method parameter value.');
        }

        if (!$userId) {
            throw new \Exception('User ID not specified.');
        }

        $response = $this->postRequest('/api/v1/users.createToken', [
            $paramType => $userId,
        ]);

        return $response;
    }

    public function openDM(string $userId): array
    {
        $response = $this->postRequest('/api/v1/im.open', [
            'roomId' => $userId,
        ]);

        return $response['room'];
    }

    public function closeDM(string $userId): bool
    {
        $response = $this->postRequest('/api/v1/im.close', [
            'roomId' => $userId,
        ]);

        return (bool) $response['success'];
    }
}
