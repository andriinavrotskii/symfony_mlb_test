<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 17:51
 */

namespace App\Service;


use App\DTO\ScheduleParamsDTO;
use App\Entity\Schedule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ScheduleService
{
    /**
     * @instance EntityManager
     */
    protected $em;

    /**
     * ScheduleService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getSchedule(Request $request)
    {
        $data = $this->em->getRepository(ScheduleService::class)
            ->getScheduleByParams($this->getScheduleParamsDTO($request));

        return [
            'api' => 'hello',
            'data' => $data
        ];
    }

    private function getScheduleParamsDTO(Request $request)
    {
        $dto = new ScheduleParamsDTO();
        $dto->setSeason($request->get('season'));
        $dto->setAwayTeam($request->get('awayteam'));
        $dto->setHomeTeam($request->get('hometeam'));
        $dto->setStadiumId($request->get('stadium'));
        $dto->setDay($request->get('day'));

        return $dto;
    }
}