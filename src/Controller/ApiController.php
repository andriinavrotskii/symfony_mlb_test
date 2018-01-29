<?php

namespace App\Controller;

use App\Exception\ScheduleException;
use App\Service\ResponseHandlerService;
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
     *
     * @param Request $request
     * @param ScheduleService $schedule
     * @param ResponseHandlerService $responseHandler
     *
     * @return JsonResponse
     */
    public function getSchedule(Request $request, ScheduleService $schedule, ResponseHandlerService $responseHandler)
    {
        try {
            return $responseHandler->getJsonResponse([
                'data' => $schedule->getSchedule($request->query->all())
            ], ['id']);
        } catch (ScheduleException $e) {
            return $responseHandler->getJsonResponse([
                'error' => $e->getMessage()
            ], null,JsonResponse::HTTP_NOT_ACCEPTABLE);
        }

    }
}