<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MlbRepository")
 */
class Mlb
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $awayTeam;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $homeTeam;

    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $stadiumId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param \DateTime $day
     */
    public function setDay(\DateTime $day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param mixed $awayTeam
     */
    public function setAwayTeam($awayTeam)
    {
        $this->awayTeam = $awayTeam;
    }

    /**
     * @return mixed
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param mixed $homeTeam
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return mixed
     */
    public function getStadiumId()
    {
        return $this->stadiumId;
    }

    /**
     * @param mixed $stadiumId
     */
    public function setStadiumId($stadiumId)
    {
        $this->stadiumId = $stadiumId;
    }
}
