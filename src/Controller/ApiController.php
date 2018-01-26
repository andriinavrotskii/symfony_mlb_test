<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 16:56
 */

namespace App\Controller;

use App\Service\GetSchedule;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiController extends Controller
{
    /**
     * @Route("/api/get_schedule", name="api_get_schedule")
     * @Method("GET")
     */
    public function getSchedule(Request $request, GetSchedule $service)
    {
        return new JsonResponse(
            $service->getSchedule($request)
        );
    }
}