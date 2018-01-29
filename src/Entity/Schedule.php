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
    public function getId(): int
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
    public function setSeason(int $season): void
    {
        $this->season = $season;
    }


    /**
     * @return \DateTime
     */
    public function getDay(): \DateTime
    {
        return $this->day;
    }

    /**
     * @param \DateTime $day
     */
    public function setDay(\DateTime $day): void
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
    public function setAwayTeam(string $awayTeam): void
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
    public function setHomeTeam(string $homeTeam): void
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
    public function setStadiumId(int $stadiumId): void
    {
        $this->stadiumId = $stadiumId;
    }
}
