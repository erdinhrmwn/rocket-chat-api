<?php

namespace ErdinHrmwn\RocketChat\Http;

class ChatService extends ApiService
{
    public function sendMessage(string $roomId, string $text, array $attachments = []): array
    {
        $payload = [
            'rid'         => $roomId,
            'msg'         => $text,
            'attachments' => $attachments,
        ];

        $response = $this->postRequest('/api/v1/chat.postMessage', $payload);

        return $response['message'];
    }

    public function updateMessage(string $messageId, string $roomId, string $text): array
    {
        $payload = [
            'msgId'  => $messageId,
            'roomId' => $roomId,
            'text'   => $text,
        ];

        $response = $this->postRequest('/api/v1/chat.update', $payload);

        return $response['message'];
    }

    public function deleteMessage(string $messageId, string $roomId): array
    {
        $payload = [
            'msgId'  => $messageId,
            'roomId' => $roomId,
            'asUser' => false,
        ];

        $response = $this->postRequest('/api/v1/chat.delete', $payload);

        return $response['message'];
    }

    public function pinMessage(string $messageId): array
    {
        $response = $this->postRequest('/api/v1/chat.pinMessage', ['messageId' => $messageId]);

        return $response['message'];
    }

    public function unpinMessage(string $messageId): bool
    {
        $response = $this->postRequest('/api/v1/chat.unpinMessage', ['messageId' => $messageId]);

        return (bool) $response['success'];
    }

    public function reactToMessage(string $messageId, string $emoji): bool
    {
        $response = $this->postRequest('/api/v1/chat.react', [
            'messageId'   => $messageId,
            'emoji'       => $emoji,
            'shouldReact' => true,
        ]);

        return (bool) $response['success'];
    }

    public function searchMessages(string $roomId, string $text): array
    {
        $response = $this->postRequest('/api/v1/chat.search', [
            'roomId'     => $roomId,
            'searchText' => $text,
        ]);

        return $response['messages'];
    }

    public function getPinnedMessages(string $roomId): array
    {
        $response = $this->getRequest('/api/v1/chat.getPinnedMessages', ['roomId' => $roomId]);

        return $response['messages'];
    }
}
