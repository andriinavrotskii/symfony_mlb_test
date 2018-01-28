<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 17:51
 */

namespace App\Service;

use App\Entity\Schedule;
use App\Exception\ScheduleException;
use App\Repository\ScheduleRepository;
use Doctrine\ORM\EntityManagerInterface;

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

    /**
     * @param array $requestData
     * @return array
     */
    public function getSchedule(array $requestData)
    {
        $this->checkRequestData($requestData);

        /** @var ScheduleRepository $scheduleRepository */
        $scheduleRepository = $this->em->getRepository(Schedule::class);
        return $scheduleRepository->findBy($requestData);
    }

    /**
     * @param array $requestData
     * @throws \Exception
     */
    protected function checkRequestData(array $requestData)
    {
        $allowedKeys = ["season", "day", "awayTeam", "homeTeam", "stadiumId"];

        foreach ($requestData as $key => $value) {
            if (!in_array($key, $allowedKeys)) {
                throw new ScheduleException(
                    "Key '{$key}' not allowed. Allowed keys: '" . implode("', '", $allowedKeys) . "'."
                );
            }
        }
    }
}