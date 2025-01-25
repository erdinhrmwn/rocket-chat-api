<?php

namespace ErdinHrmwn\RocketChat\Http;

use ErdinHrmwn\RocketChat\Entities\Group;

class GroupService extends ApiService
{
    public function create(string $name, array $members = []): Group
    {
        $endpoint = '/api/v1/groups.create';

        $payload = [
            'name' => $name,
            'members' => $members,
            'readOnly' => false,
        ];

        $response = $this->postRequest($endpoint, $payload);

        $group = new Group;
        $group->setId($response['group']['_id']);
        $group->setName($response['group']['name']);
        $group->setMessagesCount($response['group']['msgs']);

        return $group;
    }

    /**
     * @return array<Group>
     */
    public function list(array $options = []): array
    {
        $endpoint = '/api/v1/groups.list';

        $response = $this->getRequest($endpoint, $options);

        $groups = [];

        foreach ($response['groups'] as $c) {
            $group = new Group;
            $group->setId($c['_id']);
            $group->setName($c['name']);
            $group->setMessagesCount($c['msgs']);

            $groups[] = $group;
        }

        return $groups;
    }

    public function members(string $roomId): array
    {
        $endpoint = '/api/v1/groups.members';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        return $response['members'];
    }

    public function getInfo(string $roomId): Group
    {
        $endpoint = '/api/v1/groups.info';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        $group = new Group;
        $group->setId($response['group']['_id']);
        $group->setName($response['group']['name']);
        $group->setMessagesCount($response['group']['msgs']);
        $group->setMembersCount($response['group']['usersCount']);

        $members = $this->members($response['group']['_id']);
        $group->setMembers($members);

        return $group;
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

    public function invite(string $roomId, string $userId): Group
    {
        $endpoint = '/api/v1/groups.invite';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        $group = new Group;
        $group->setId($response['group']['_id']);
        $group->setName($response['group']['name']);
        $group->setMessagesCount($response['group']['msgs']);
        $group->setMembersCount(count($response['group']['usernames']));

        return $group;
    }

    public function kick(string $roomId, string $userId): Group
    {
        $endpoint = '/api/v1/groups.kick';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        $group = new Group;
        $group->setId($response['group']['_id']);
        $group->setName($response['group']['name']);
        $group->setMessagesCount($response['group']['msgs']);
        $group->setMembersCount(count($response['group']['usernames']));

        return $group;
    }

    public function leave(string $roomId): Group
    {
        $endpoint = '/api/v1/groups.leave';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        $group = new Group;
        $group->setId($response['group']['_id']);
        $group->setName($response['group']['name']);
        $group->setMessagesCount($response['group']['msgs']);
        $group->setMembersCount(count($response['group']['usernames']));

        return $group;
    }

    public function rename(string $roomId, string $name): Group
    {
        $endpoint = '/api/v1/groups.rename';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'name' => $name]);

        $group = new Group;
        $group->setId($response['group']['_id']);
        $group->setName($response['group']['name']);
        $group->setMessagesCount($response['group']['msgs']);
        $group->setMembersCount(count($response['group']['usernames']));

        return $group;
    }
}
