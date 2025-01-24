<?php

namespace ErdinHrmwn\RocketChat\Http;

class ChannelService extends ApiService
{
    public function create(string $name, array $members = [], string $description = ''): array
    {
        $endpoint = '/api/v1/channels.create';

        $payload = [
            'name'     => $name,
            'members'  => $members,
            'readOnly' => false,
        ];

        if (!empty($description)) {
            $payload['description'] = $description;
        }

        $response = $this->postRequest($endpoint, $payload);

        return $response['channel'];
    }

    public function list(array $options = []): array
    {
        $endpoint = '/api/v1/channels.list';

        $response = $this->getRequest($endpoint, $options);

        return $response['channels'];
    }

    public function members(string $roomId): array
    {
        $endpoint = '/api/v1/channels.members';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        return $response['members'];
    }

    public function getInfo(string $roomId): array
    {
        $endpoint = '/api/v1/channels.info';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        return $response['channel'];
    }

    public function archive(string $roomId): bool
    {
        $endpoint = '/api/v1/channels.archive';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return (bool) $response['success'];
    }

    public function unarchive(string $roomId): bool
    {
        $endpoint = '/api/v1/channels.unarchive';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return (bool) $response['success'];
    }

    public function delete(string $roomId): bool
    {
        $endpoint = '/api/v1/channels.delete';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return (bool) $response['success'];
    }

    public function invite(string $roomId, string $userId): array
    {
        $endpoint = '/api/v1/channels.invite';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        return $response['channel'];
    }

    public function kick(string $roomId, string $userId): array
    {
        $endpoint = '/api/v1/channels.kick';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        return $response['channel'];
    }

    public function leave(string $roomId): array
    {
        $endpoint = '/api/v1/channels.leave';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return $response['channel'];
    }

    public function rename(string $roomId, string $name): array
    {
        $endpoint = '/api/v1/channels.rename';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'name' => $name]);

        return $response['channel'];
    }
}
