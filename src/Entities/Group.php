<?php

namespace ErdinHrmwn\RocketChat\Entities;

class Group
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

    public function setId(string $id): Group
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Group
    {
        $this->name = $name;
        return $this;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): Group
    {
        $this->topic = $topic;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Group
    {
        $this->description = $description;
        return $this;
    }

    public function getMembers(): array
    {
        return $this->members;
    }

    public function setMembers(array $members = []): Group
    {
        $this->members = $members;
        return $this;
    }

    public function getMembersCount(): int
    {
        return $this->membersCount;
    }

    public function setMembersCount(int $membersCount = 0): Group
    {
        $this->membersCount = $membersCount;
        return $this;
    }

    public function getMessagesCount(): int
    {
        return $this->messagesCount;
    }

    public function setMessagesCount(int $messagesCount = 0): Group
    {
        $this->messagesCount = $messagesCount;
        return $this;
    }

    public static function fromArray(array $data): Group
    {
        $group = new Group;
        $group->setId($data['_id']);
        $group->setName($data['name']);
        $group->setTopic($data['topic']);
        $group->setDescription($data['description']);
        $group->setMembers($data['members']);
        $group->setMembersCount($data['usersCount']);
        $group->setMessagesCount($data['msgs']);

        return $group;
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
