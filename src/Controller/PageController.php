<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 17:19
 */

namespace App\Controller;

use App\Exception\ScheduleException;
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
        try {
            $data = $service->getSchedule($request->query->all());
        } catch (ScheduleException $e) {
            $error = $e->getMessage();
        }

        return $this->render('schedule/index.html.twig', [
            'data' => isset($data) ? $data : null,
            'error' => isset($error) ? $error : null
        ]);
    }
}