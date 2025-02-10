<?php

namespace ErdinHrmwn\RocketChat\Http;

class RoomService extends ApiService
{
    public function list(array $options = []): array
    {
        $response = $this->getRequest('/api/v1/rooms.get', $options);

        return $response['update'];
    }

    public function getInfo(string $roomId): array
    {
        $response = $this->postRequest('/api/v1/rooms.info', [
            'roomId' => $roomId,
        ]);

        return $response['room'];
    }

    public function leave(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/rooms.leave', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function delete(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/rooms.delete', [
            'roomId' => $roomId,
        ]);

        return (bool) $response['success'];
    }

    public function archive(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/rooms.changeArchivationState', [
            'rid' => $roomId,
            'action' => 'archive',
        ]);

        return (bool) $response['success'];
    }

    public function unarchive(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/rooms.changeArchivationState', [
            'rid' => $roomId,
            'action' => 'unarchive',
        ]);

        return (bool) $response['success'];
    }

    public function favorite(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/rooms.favorite', [
            'roomId' => $roomId,
            'favorite' => true,
        ]);

        return (bool) $response['success'];
    }

    public function unfavorite(string $roomId): bool
    {
        $response = $this->postRequest('/api/v1/rooms.favorite', [
            'roomId' => $roomId,
            'favorite' => false,
        ]);

        return (bool) $response['success'];
    }
}
