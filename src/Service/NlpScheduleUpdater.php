<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 11:44
 */

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class NlpScheduleUpdater
{

    /**
     * @instance EntityManager
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}