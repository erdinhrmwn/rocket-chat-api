<?php

namespace ErdinHrmwn\RocketChat\Http;

class ChannelService extends ApiService
{
    public function create(string $name, array $members = [], ?string $description = null): array
    {
        $response = $this->postRequest('/api/v1/channels.create', [
            'name' => $name,
            'members' => $members,
            'readOnly' => false,
            'description' => $description,
        ]);

        return $response['channel'];
    }

    public function list(array $options = []): array
    {
        $response = $this->getRequest('/api/v1/channels.list', $options);

        return $response['channels'];
    }

    public function members(string $roomId): array
    {
        $response = $this->getRequest('/api/v1/channels.members', [
            'roomId' => $roomId,
        ]);

        return $response['members'];
    }

    public function getInfo(string $roomId): array
    {
        $response = $this->getRequest('/api/v1/channels.info', [
            'roomId' => $roomId,
        ]);

        return $response['channel'];
    }

    public function archive(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/channels.archive', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function unarchive(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/channels.unarchive', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function delete(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/channels.delete', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function invite(string $roomId, string $userId): array
    {
        $response = $this->postRequest('/api/v1/channels.invite', [
            'roomId' => $roomId,
            'userId' => $userId,
        ]);

        return $response['channel'];
    }

    public function kick(string $roomId, string $userId): array
    {
        $response = $this->postRequest('/api/v1/channels.kick', [
            'roomId' => $roomId,
            'userId' => $userId,
        ]);

        return $response['channel'];
    }

    public function leave(string $roomId): array
    {
        $response = $this->postRequest('/api/v1/channels.leave', [
            'roomId' => $roomId,
        ]);

        return $response['channel'];
    }

    public function rename(string $roomId, string $name): array
    {
        $response = $this->postRequest('/api/v1/channels.rename', [
            'roomId' => $roomId,
            'name' => $name,
        ]);

        return $response['channel'];
    }
}
