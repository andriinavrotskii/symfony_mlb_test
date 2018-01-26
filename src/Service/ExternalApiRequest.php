<?php

namespace App\Service;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\RequestException;


class ExternalApiRequest
{
    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * ExternalApiRequest constructor.
     * @param Guzzle $guzzle
     */
    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    protected function apiRequest($url)
    {
        try {
            $client = new Guzzle;
            $response = $client->request('GET', $url);

            if ($response->getStatusCode() !== 200) {
                throw new \Exception("NASA API error: Status code " . $response->getStatusCode());
            }

            return $response;

        } catch (RequestException $e) {
            throw new \Exception("NASA API error: " . $e->getMessage());
        }
    }
}