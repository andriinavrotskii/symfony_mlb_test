<?php

namespace App\Service;

use App\Exception\ExternalApiException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;


class ExternalApiRequestService
{
    /**
     * @param $url
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws ExternalApiException
     */
    public function send($url, $headers = [], $method = 'GET')
    {
        $options = [];

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        try {
            $client = new GuzzleClient();
            $response = $client->request($method, $url, $options);

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new ExternalApiException("API error: Status code " . $response->getStatusCode());
            }

            if (!$response->getBody()) {
                throw new ExternalApiException("API error: Response body is empty");
            }

            return json_decode((string) $response->getBody());

        } catch (RequestException $e) {
            throw new ExternalApiException("API error: " . $e->getMessage());
        }
    }
}