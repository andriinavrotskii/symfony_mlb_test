<?php

namespace App\Service;

use App\Entity\Schedule;
use App\Exception\ExternalApiException;
use App\Exception\SchedulerUpdaterException;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;

class ScheduleUpdaterService
{

    protected const FANTASYDATA_API_URL = 'https://api.fantasydata.net/mlb/v2/json/Games/';

    /**
     * @instance EntityManager
     */
    protected $em;

    /**
     * @var ExternalApiRequestService
     */
    protected $externalApiRequest;

    /**
     * @var string
     */
    protected $subscriptionKey;

    /**
     * NlpScheduleUpdater constructor.
     * @param EntityManagerInterface $em
     * @param ExternalApiRequestService $externalApiRequest
     */
    public function __construct(EntityManagerInterface $em, ExternalApiRequestService $externalApiRequest, $subscriptionKey)
    {
        $this->em = $em;
        $this->externalApiRequest = $externalApiRequest;
        $this->subscriptionKey = $subscriptionKey;
    }

    /**
     * @param $season
     * @throws SchedulerUpdaterException
     */
    public function update($season)
    {
        $scheduleData = $this->getScheduleData($season);

        if (empty($scheduleData)) {
            throw new SchedulerUpdaterException('No data for set');
        }

        try {
            $this->removeScheduleBySeason($season);
            $this->setScheduleDataToDB($scheduleData);
        } catch (DBALException $e) {
            throw new SchedulerUpdaterException($e->getMessage());
        }
    }

    /**
     * @param $season
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws SchedulerUpdaterException
     */
    protected function getScheduleData($season)
    {
        $url = self::FANTASYDATA_API_URL . $season;
        $headers = [
            'Ocp-Apim-Subscription-Key' => $this->subscriptionKey,
        ];

        try {
            return $this->externalApiRequest->send($url, $headers);
        } catch (ExternalApiException $e) {
            throw new SchedulerUpdaterException($e->getMessage());
        }
    }

    /**
     * @param $season
     */
    protected function removeScheduleBySeason($season)
    {
        $this->em->getRepository(Schedule::class)->removeScheduleBySeason($season);
    }

    /**
     * @param array $scheduleData
     */
    protected function setScheduleDataToDB(array $scheduleData)
    {
        foreach ($scheduleData as $item) {
            $schedule = new Schedule();
            $schedule->setSeason($item->Season);
            $schedule->setDay(new \DateTime($item->Day));
            $schedule->setAwayTeam($item->AwayTeam);
            $schedule->setHomeTeam($item->HomeTeam);
            $schedule->setStadiumId($item->StadiumID);

            $this->em->persist($schedule);
        }
        $this->em->flush();
    }

}