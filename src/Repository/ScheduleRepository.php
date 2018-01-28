<?php

namespace App\Repository;

use App\DTO\ScheduleParamsDTO;
use App\Entity\Schedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ScheduleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Schedule::class);
    }

    /**
     * @param $season
     * @return mixed
     */
    public function removeScheduleBySeason($season)
    {
        return $this->createQueryBuilder('s')
            ->delete()
            ->where('s.season  = :season')->setParameter("season", $season)
            ->getQuery()->execute();
    }
}
