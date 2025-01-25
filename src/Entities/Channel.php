<?php

namespace ErdinHrmwn\RocketChat\Entities;

class Channel
{
    private string $id;

    private string $name;

    private string $topic;

    private ?string $description;

    private array $members = [];

    private int $membersCount = 0;

    private int $messagesCount = 0;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Channel
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Channel
    {
        $this->name = $name;
        return $this;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): Channel
    {
        $this->topic = $topic;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Channel
    {
        $this->description = $description;
        return $this;
    }

    public function getMembers(): array
    {
        return $this->members;
    }

    public function setMembers(array $members = []): Channel
    {
        $this->members = $members;
        return $this;
    }

    public function getMembersCount(): int
    {
        return $this->membersCount;
    }

    public function setMembersCount(int $membersCount = 0): Channel
    {
        $this->membersCount = $membersCount;
        return $this;
    }

    public function getMessagesCount(): int
    {
        return $this->messagesCount;
    }

    public function setMessagesCount(int $messagesCount = 0): Channel
    {
        $this->messagesCount = $messagesCount;
        return $this;
    }

    public static function fromArray(array $data): Channel
    {
        $channel = new Channel;
        $channel->setId($data['_id']);
        $channel->setName($data['name']);
        $channel->setTopic($data['topic']);
        $channel->setDescription($data['description']);
        $channel->setMembers($data['members']);
        $channel->setMembersCount($data['usersCount']);
        $channel->setMessagesCount($data['msgs']);

        return $channel;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'topic' => $this->getTopic(),
            'description' => $this->getDescription(),
            'members' => $this->getMembers(),
            'membersCount' => $this->getMembersCount(),
            'messagesCount' => $this->getMessagesCount(),
        ];
    }

    public function toJson(): object
    {
        return (object) $this->toArray();
    }
}
