<?php

namespace ErdinHrmwn\RocketChat\Http;

use ErdinHrmwn\RocketChat\Entities\User;

class UserService extends ApiService
{
    /**
     * @return array<int, User>
     */
    public function all(): array
    {
        $response = $this->getRequest('/api/v1/users.list', ['count' => 0]);

        return array_map(fn (array $user): User => User::fromArray($user), $response['users']);
    }

    /**
     * @param  array<string, mixed>  $params
     * @return array<int, User>
     */
    public function getList(array $params = []): array
    {
        $response = $this->getRequest('/api/v1/users.list', $params);

        return array_map(fn (array $user): User => User::fromArray($user), $response['users']);
    }

    /**
     * @throws \Exception
     */
    public function getInfo(string $userId, string $paramType = 'userId'): User
    {
        if (!in_array($paramType, ['userId', 'username'])) {
            throw new \Exception('Bad method parameter value.');
        }

        if (!$userId) {
            throw new \Exception('User ID not specified.');
        }

        $response = $this->getRequest('/api/v1/users.info', [$paramType => $userId]);

        return User::fromArray($response['user']);
    }

    /**
     * @param  array<string, mixed>  $userData
     */
    public function create(array $userData): User
    {
        $response = $this->postRequest('/api/v1/users.create', $userData);

        return User::fromArray($response['user']);
    }

    /**
     * @param  array<string, mixed>  $userData
     */
    public function update(string $userId, array $userData): User
    {
        $payload = [
            'userId' => $userId,
            'data' => $userData,
        ];

        $response = $this->postRequest('/api/v1/users.update', $payload);

        return User::fromArray($response['user']);
    }

    public function delete(string $userId): bool
    {
        $response = $this->postRequest('/api/v1/users.delete', ['userId' => $userId]);

        return (bool) $response['success'];
    }

    /**
     * @return array<string, mixed>
     *
     * @throws \Exception
     */
    public function createToken(string $userId, string $paramType = 'userId'): array
    {
        if (!in_array($paramType, ['userId', 'username'])) {
            throw new \Exception('Bad method parameter value.');
        }

        if (!$userId) {
            throw new \Exception('User ID not specified.');
        }

        $response = $this->postRequest('/api/v1/users.createToken', [$paramType => $userId]);

        return $response;
    }

    public function openDM(string $userId): array
    {
        $response = $this->postRequest('/api/v1/im.open', ['roomId' => $userId]);

        return $response['room'];
    }

    public function disableDM(string $userId): bool
    {
        $response = $this->postRequest('/api/v1/im.close', ['roomId' => $userId]);

        return (bool) $response['success'];
    }
}
