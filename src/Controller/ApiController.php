<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 16:56
 */

namespace App\Controller;

use App\Service\ScheduleService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    /**
     * @Route("/api/schedule", name="api_get_schedule")
     * @Method("GET")

     * @param Request $request
     * @param ScheduleService $service
     *
     * @return JsonResponse
     */
    public function getSchedule(Request $request, ScheduleService $service)
    {
        $data = $service->getSchedule($request->query->all());
        $status = empty($data) ? JsonResponse::HTTP_NOT_ACCEPTABLE : JsonResponse::HTTP_OK;

        return $this->getJsonResponse([
            'data' => $data
        ], $status);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    private function getJsonResponse($data, $code = 200)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        return new JsonResponse($serializer->serialize($data, 'json'), $code, [], true);
    }
}