<?php

namespace Payhub\Service;

use Payhub\Contracts\HttpClient;

class Webhook
{
    public function __construct(protected HttpClient $client)
    {
    }

    /**
     * @return array<\Payhub\Models\Webhook>
     */
    public function all(): array
    {
        $response = $this->client->get('{key}/webhook');

        return array_map(fn ($item) => new \Payhub\Models\Webhook($item), $response);
    }

    public function get(\Payhub\Models\Webhook $webhook): \Payhub\Models\Webhook
    {
        $response = $this->client->get('{key}/webhook/'.$webhook->getId());

        return new \Payhub\Models\Webhook($response);
    }

    public function create(\Payhub\Models\Webhook $webhook): \Payhub\Models\Webhook
    {
        $response = $this->client->post('{key}/webhook', $webhook->toArray());

        return new \Payhub\Models\Webhook($response);
    }

    public function update(\Payhub\Models\Webhook $webhook): \Payhub\Models\Webhook
    {
        $response = $this->client->put('{key}/webhook/'.$webhook->getId(), $webhook->toArray());

        return new \Payhub\Models\Webhook($response);
    }

    public function delete(\Payhub\Models\Webhook $webhook): void
    {
        $this->client->delete('{key}/webhook/'.$webhook->getId());
    }
}
