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
        $this->authToken = Session::get('rocketchat_auth_token');
        $this->userId = Session::get('rocketchat_user_id');

        $baseUrl = config('rocketchat.instance');

        if (!$baseUrl) {
            throw new \Exception('RocketChat instance URL not set.');
        }

        $this->client = Http::createPendingRequest()
            ->baseUrl($baseUrl)
            ->withHeaders([
                'X-Auth-Token' => $this->authToken,
                'X-User-Id' => $this->userId,
            ])
            ->acceptJson()
            ->asJson()
            ->throw();

        if (!$this->authToken || !$this->userId) {
            $username = config('rocketchat.admin_username');
            $password = config('rocketchat.admin_password');

            if (!$username || !$password) {
                throw new \Exception('RocketChat admin username or password not set.');
            }

            $this->authenticate($username, $password);
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

            $this->client->replaceHeaders([
                'X-Auth-Token' => $this->authToken,
                'X-User-Id' => $this->userId,
            ]);

            Session::put('rocketchat_auth_token', $this->authToken);
            Session::put('rocketchat_user_id', $this->userId);
        } catch (RequestException $th) {
            throw new \Exception('Error authenticating: ' . $th->response->body());
        }
    }

    public function me(): array
    {
        try {
            $response = $this->client->get('/api/v1/me');

            return $response->json();
        } catch (RequestException $th) {
            throw new \Exception('Error fetching user info: ' . $th->response->body());
        }
    }

    public function getServerInfo(): array
    {
        try {
            $response = $this->client->get('/api/v1/info');

            return $response->json();
        } catch (RequestException $th) {
            throw new \Exception('Error fetching server info: ' . $th->response->body());
        }
    }

    public function users()
    {
        return new UserService($this->client);
    }

    public function roles()
    {
        return new RoleService($this->client);
    }

    public function permissions()
    {
        return new PermissionService($this->client);
    }

    public function groups()
    {
        return new GroupService($this->client);
    }

    public function channels()
    {
        return new ChannelService($this->client);
    }

    public function chats()
    {
        return new ChatService($this->client);
    }
}
