<?php

namespace ErdinHrmwn\RocketChat\Http;

class GroupService extends ApiService
{
    public function create(string $name, array $members = [], string $description = ''): array
    {
        $endpoint = '/api/v1/groups.create';

        $payload = [
            'name'     => $name,
            'members'  => $members,
            'readOnly' => false,
        ];

        if (!empty($description)) {
            $payload['description'] = $description;
        }

        $response = $this->postRequest($endpoint, $payload);

        return $response['group'];
    }

    public function list(array $options = []): array
    {
        $endpoint = '/api/v1/groups.list';

        $response = $this->getRequest($endpoint, $options);

        return $response['groups'];
    }

    public function members(string $roomId): array
    {
        $endpoint = '/api/v1/groups.members';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        return $response['members'];
    }

    public function getInfo(string $roomId): array
    {
        $endpoint = '/api/v1/groups.info';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        return $response['group'];
    }

    public function archive(string $roomId): bool
    {
        $endpoint = '/api/v1/groups.archive';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return (bool) $response['success'];
    }

    public function unarchive(string $roomId): bool
    {
        $endpoint = '/api/v1/groups.unarchive';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return (bool) $response['success'];
    }

    public function delete(string $roomId): bool
    {
        $endpoint = '/api/v1/groups.delete';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return (bool) $response['success'];
    }

    public function invite(string $roomId, string $userId): array
    {
        $endpoint = '/api/v1/groups.invite';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        return $response['group'];
    }

    public function kick(string $roomId, string $userId): array
    {
        $endpoint = '/api/v1/groups.kick';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        return $response['group'];
    }

    public function leave(string $roomId): array
    {
        $endpoint = '/api/v1/groups.leave';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        return $response['group'];
    }

    public function rename(string $roomId, string $name): array
    {
        $endpoint = '/api/v1/groups.rename';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'name' => $name]);

        return $response['group'];
    }
}
