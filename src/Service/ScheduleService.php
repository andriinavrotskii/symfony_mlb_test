<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 17:51
 */

namespace App\Service;

use App\Entity\Schedule;
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
        return $this->em->getRepository(Schedule::class)
            ->findBy($requestData);
    }
}