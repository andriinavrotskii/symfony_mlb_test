<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScheduleRepository")
 */
class Schedule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=4)
     */
    private $season;

    /**
     * @ORM\Column(type="date")
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
     * @return int
     */
    private function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSeason(): int
    {
        return $this->season;
    }

    /**
     * @param int $season
     */
    public function setSeason(int $season)
    {
        $this->season = $season;
    }


    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day->format('Y-m-d');
    }

    /**
     * @param \DateTime $day
     */
    public function setDay(\DateTime $day)
    {
        $this->day = $day;
    }


    /**
     * @return string
     */
    public function getAwayTeam(): string
    {
        return $this->awayTeam;
    }

    /**
     * @param string $awayTeam
     */
    public function setAwayTeam(string $awayTeam)
    {
        $this->awayTeam = $awayTeam;
    }

    /**
     * @return string
     */
    public function getHomeTeam(): string
    {
        return $this->homeTeam;
    }

    /**
     * @param string $homeTeam
     */
    public function setHomeTeam(string $homeTeam)
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return int
     */
    public function getStadiumId(): int
    {
        return $this->stadiumId;
    }

    /**
     * @param int $stadiumId
     */
    public function setStadiumId(int $stadiumId)
    {
        $this->stadiumId = $stadiumId;
    }
}
