<?php

namespace ErdinHrmwn\RocketChat\Http;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;

abstract class ApiService
{
    protected PendingRequest $client;

    protected string $authToken;

    protected string $userId;

    public function __construct(PendingRequest $client)
    {
        $this->client = $client;
    }

    protected function getRequest(string $endpoint, array $query = []): array
    {
        try {
            $response = $this->client->get($endpoint, $query);

            return $response->json();
        } catch (RequestException  $th) {
            throw new \Exception('[RequestException] API request failed: ' . $th->response->body());
        } catch (ConnectionException $th) {
            throw new \Exception('[ConnectionException] API request failed: ' . $th->getMessage());
        } catch (\Throwable $th) {
            throw new \Exception('[Exception] API request failed: ' . $th->getMessage());
        }
    }

    protected function postRequest(string $endpoint, array $body): array
    {
        try {
            $response = $this->client->post($endpoint, $body);

            return $response->json();
        } catch (RequestException  $th) {
            throw new \Exception('[RequestException] API request failed: ' . $th->response->body());
        } catch (ConnectionException $th) {
            throw new \Exception('[ConnectionException] API request failed: ' . $th->getMessage());
        } catch (\Throwable $th) {
            throw new \Exception('[Exception] API request failed: ' . $th->getMessage());
        }
    }
}
