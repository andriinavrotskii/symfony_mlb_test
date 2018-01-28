<?php
/**
 * Created by PhpStorm.
 * User: navrotskiy
 * Date: 26.01.18
 * Time: 18:01
 */

namespace App\DTO;


class ScheduleParamsDTO
{
    /**
     * @var integer
     */
    private $season;

    /**
     * @var \DateTime
     */
    private $day;

    /**
     * @var string
     */
    private $awayTeam;

    /**
     * @var string
     */
    private $homeTeam;

    /**
     * @var integer
     */
    private $stadiumId;

    /**
     * @return int
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param int $season
     */
    public function setSeason($season = null)
    {
        $this->season = $season;
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
    public function setDay($day = null)
    {
        if (empty($day)) {
            return;
        }

        if ($day instanceof \DateTime) {
            $this->day = $day;
            return;
        }

        $day = \DateTime::createFromFormat('Y-m-d', $day);
        if ($day) {
            $this->day = $day;
            return;
        }
    }

    /**
     * @return string
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param string $awayTeam
     */
    public function setAwayTeam($awayTeam = null)
    {
        $this->awayTeam = $awayTeam;
    }

    /**
     * @return string
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param string $homeTeam
     */
    public function setHomeTeam($homeTeam = null)
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return int
     */
    public function getStadiumId()
    {
        return $this->stadiumId;
    }

    /**
     * @param int $stadiumId
     */
    public function setStadiumId($stadiumId = null)
    {
        $this->stadiumId = $stadiumId;
    }


    /**
     * @return array
     */
    public function getConditions()
    {
        $result = [];
        foreach ($this as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $result[$key] = $value;
        }
        return $result;
    }
}