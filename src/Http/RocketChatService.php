<?php

namespace ErdinHrmwn\RocketChat\Http;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RocketChatService
{
    protected PendingRequest $client;

    protected ?string $authToken;

    protected ?string $userId;

    public function __construct()
    {
        $this->client = Http::createPendingRequest()
            ->baseUrl(config('rocketchat.instance'))
            ->acceptJson()
            ->asJson()
            ->throw();

        $this->authToken = Session::get('rocketchat_auth_token');
        $this->userId = Session::get('rocketchat_user_id');

        if (!$this->authToken || !$this->userId) {
            $this->authenticate(config('rocketchat.admin_username'), config('rocketchat.admin_password'));
        }
    }

    protected function authenticate($username, $password): void
    {
        try {
            $response = $this->client->post('/api/v1/login', [
                'user' => $username,
                'password' => $password,
            ]);

            $body = $response->json();

            if ($body['status'] !== 'success') {
                throw new \Exception('Authentication failed: ' . $body['message']);
            }

            $this->authToken = $body['data']['authToken'];
            $this->userId = $body['data']['userId'];

            Session::put('rocketchat_auth_token', $this->authToken);
            Session::put('rocketchat_user_id', $this->userId);
        } catch (RequestException $th) {
            throw new \Exception('Error authenticating: ' . $th->response->body());
        }
    }

    public function getServerInfo(): array
    {
        try {
            $response = $this->client
                ->withHeaders([
                    'X-Auth-Token' => $this->authToken,
                    'X-User-Id' => $this->userId,
                ])
                ->get('/api/v1/info');

            return $response->json();
        } catch (RequestException $th) {
            throw new \Exception('Error fetching server info: ' . $th->response->body());
        }
    }

    public function users()
    {
        return new UserService($this->client, $this->authToken, $this->userId);
    }

    public function roles()
    {
        return new RoleService($this->client, $this->authToken, $this->userId);
    }

    public function permissions()
    {
        return new PermissionService($this->client, $this->authToken, $this->userId);
    }

    public function groups()
    {
        return new GroupService($this->client, $this->authToken, $this->userId);
    }

    public function channels()
    {
        return new ChannelService($this->client, $this->authToken, $this->userId);
    }

    public function chats()
    {
        return new ChatService($this->client, $this->authToken, $this->userId);
    }
}
