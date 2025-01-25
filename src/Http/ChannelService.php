<?php

namespace ErdinHrmwn\RocketChat\Http;

use ErdinHrmwn\RocketChat\Entities\Channel;

class ChannelService extends ApiService
{
    public function create(string $name, array $members = []): Channel
    {
        $endpoint = '/api/v1/channels.create';

        $payload = [
            'name' => $name,
            'members' => $members,
            'readOnly' => false,
        ];

        $response = $this->postRequest($endpoint, $payload);

        $channel = new Channel;
        $channel->setId($response['channel']['_id']);
        $channel->setName($response['channel']['name']);
        $channel->setMessagesCount($response['channel']['msgs']);
        $channel->setMembersCount($response['channel']['usersCount']);

        return $channel;
    }

    /**
     * @return array<Channel>
     */
    public function list(array $options = []): array
    {
        $endpoint = '/api/v1/channels.list';

        $response = $this->getRequest($endpoint, $options);

        $channels = [];

        foreach ($response['channels'] as $c) {
            $channel = new Channel;
            $channel->setId($c['_id']);
            $channel->setName($c['name']);
            $channel->setTopic($c['topic']);
            $channel->setDescription($c['description']);
            $channel->setMessagesCount($c['msgs']);
            $channel->setMembersCount($c['usersCount']);

            $channels[] = $channel;
        }

        return $channels;
    }

    public function members(string $roomId): array
    {
        $endpoint = '/api/v1/channels.members';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        return $response['members'];
    }

    public function getInfo(string $roomId): Channel
    {
        $endpoint = '/api/v1/channels.info';

        $response = $this->getRequest($endpoint, ['roomId' => $roomId]);

        $channel = new Channel;
        $channel->setId($response['channel']['_id']);
        $channel->setName($response['channel']['name']);
        $channel->setTopic($response['channel']['topic']);
        $channel->setMessagesCount($response['channel']['msgs']);
        $channel->setMembersCount($response['channel']['usersCount']);

        $members = $this->members($response['channel']['_id']);
        $channel->setMembers($members);

        return $channel;
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

    public function invite(string $roomId, string $userId): Channel
    {
        $endpoint = '/api/v1/channels.invite';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        $channel = new Channel;
        $channel->setId($response['channel']['_id']);
        $channel->setName($response['channel']['name']);
        $channel->setDescription($response['channel']['description']);
        $channel->setMessagesCount($response['channel']['msgs']);
        $channel->setMembersCount($response['channel']['usersCount']);

        return $channel;
    }

    public function kick(string $roomId, string $userId): Channel
    {
        $endpoint = '/api/v1/channels.kick';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'userId' => $userId]);

        $channel = new Channel;
        $channel->setId($response['channel']['_id']);
        $channel->setName($response['channel']['name']);
        $channel->setTopic($response['channel']['topic']);
        $channel->setMessagesCount($response['channel']['msgs']);
        $channel->setMembersCount($response['channel']['usersCount']);

        return $channel;
    }

    public function join(string $roomId): Channel
    {
        $endpoint = '/api/v1/channels.join';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        $channel = new Channel;
        $channel->setId($response['channel']['_id']);
        $channel->setName($response['channel']['name']);
        $channel->setTopic($response['channel']['topic']);
        $channel->setMessagesCount($response['channel']['msgs']);
        $channel->setMembersCount($response['channel']['usersCount']);

        return $channel;
    }

    public function leave(string $roomId): Channel
    {
        $endpoint = '/api/v1/channels.leave';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId]);

        $channel = new Channel;
        $channel->setId($response['channel']['_id']);
        $channel->setName($response['channel']['name']);
        $channel->setMessagesCount($response['channel']['msgs']);
        $channel->setMembersCount(count($response['channel']['usernames']));

        return $channel;
    }

    public function rename(string $roomId, string $name): Channel
    {
        $endpoint = '/api/v1/channels.rename';

        $response = $this->postRequest($endpoint, ['roomId' => $roomId, 'name' => $name]);

        $channel = new Channel;
        $channel->setId($response['channel']['_id']);
        $channel->setName($response['channel']['name']);
        $channel->setMessagesCount($response['channel']['msgs']);
        $channel->setMembersCount(count($response['channel']['usernames']));

        return $channel;
    }
}
