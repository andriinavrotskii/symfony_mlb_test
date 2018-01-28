<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 17:19
 */

namespace App\Controller;

use App\Service\ScheduleService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Method("GET")
     *
     * @param Request $request
     * @param ScheduleService $service
     *
     * @return Response
     */
    public function index(Request $request, ScheduleService $service)
    {
        return $this->render('schedule/index.html.twig', [
            'data' => $service->getSchedule($request->query->all())
        ]);
    }
}