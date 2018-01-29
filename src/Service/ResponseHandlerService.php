<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 29.01.18
 * Time: 12:15
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ResponseHandlerService
{
    /**
     * @param array $data
     * @param null $ignoreFields
     * @param int $code
     * @return JsonResponse
     */
    public function getJsonResponse(array $data, $ignoreFields = null, $code = JsonResponse::HTTP_OK)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer([$normalizer], $encoders);
        $this->setNormalizerCallbacks($normalizer);
        $this->setIgnoredAttributes($normalizer, $ignoreFields);

        return new JsonResponse($serializer->serialize($data, 'json'), $code, [], true);
    }

    /**
     * @param ObjectNormalizer $normalizer
     */
    protected function setNormalizerCallbacks(ObjectNormalizer $normalizer)
    {
        $callback = function ($dateTime) {
            return $dateTime instanceof \DateTime
                ? $dateTime->format("Y-m-d")
                : '';
        };
        $normalizer->setCallbacks(array('day' => $callback));
    }

    /**
     * @param ObjectNormalizer $normalizer
     * @param $ignoreFields
     */
    protected function setIgnoredAttributes(ObjectNormalizer $normalizer, $ignoreFields)
    {
        if (isset($ignoreFields)){
            $normalizer->setIgnoredAttributes($ignoreFields);
        }
    }
}