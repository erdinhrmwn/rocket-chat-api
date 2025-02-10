<?php

namespace ErdinHrmwn\RocketChat\Http;

class GroupService extends ApiService
{
    public function create(string $name, array $members = [], ?string $description = null): array
    {
        $response = $this->postRequest('/api/v1/groups.create', [
            'name' => $name,
            'members' => $members,
            'readOnly' => false,
            'description' => $description,
        ]);

        return $response['group'];
    }

    public function list(array $options = []): array
    {
        $response = $this->getRequest('/api/v1/groups.list', $options);

        return $response['groups'];
    }

    public function members(string $roomId): array
    {
        $response = $this->getRequest('/api/v1/groups.members', [
            'roomId' => $roomId,
        ]);

        return $response['members'];
    }

    public function getInfo(string $roomId): array
    {
        $response = $this->getRequest('/api/v1/groups.info', [
            'roomId' => $roomId,
        ]);

        return $response['group'];
    }

    public function archive(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/groups.archive', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function unarchive(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/groups.unarchive', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function delete(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/groups.delete', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function invite(string $roomId, string $userId): array
    {
        $response = $this->postRequest('/api/v1/groups.invite', [
            'roomId' => $roomId,
            'userId' => $userId,
        ]);

        return $response['group'];
    }

    public function kick(string $roomId, string $userId): array
    {
        $response = $this->postRequest('/api/v1/groups.kick', [
            'roomId' => $roomId,
            'userId' => $userId,
        ]);

        return $response['group'];
    }

    public function leave(string $roomId): array
    {
        $response = $this->postRequest('/api/v1/groups.leave', [
            'roomId' => $roomId,
        ]);

        return $response['group'];
    }

    public function rename(string $roomId, string $name): array
    {
        $response = $this->postRequest('/api/v1/groups.rename', [
            'roomId' => $roomId,
            'name' => $name,
        ]);

        return $response['group'];
    }
}
