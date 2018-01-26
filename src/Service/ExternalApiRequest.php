<?php

namespace App\Service;

use App\Exception\ExternalApiException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;


class ExternalApiRequest
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * ExternalApiRequest constructor.
     * @param GuzzleClient $client
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }


    /**
     * @param $url
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws ExternalApiException
     */
    protected function send($url, $method = 'GET')
    {
        try {
            $response = $this->client->request($method, $url);

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new ExternalApiException("API error: Status code " . $response->getStatusCode());
            }

            return $response;

        } catch (RequestException $e) {
            throw new ExternalApiException("API error: " . $e->getMessage());
        }
    }
}