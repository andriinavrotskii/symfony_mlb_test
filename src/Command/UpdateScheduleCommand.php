<?php

namespace App\Command;

use App\Exception\SchedulerUpdaterException;
use App\Service\ScheduleUpdaterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UpdateScheduleCommand extends Command
{
    const MIN_RANGE_INTERVAL = 50;
    const MAX_RANGE_INTERVAL = 50;

    /**
     * @var ScheduleUpdaterService
     */
    protected $updater;

    /**
     * UpdateScheduleCommand constructor.
     * @param null $name
     * @param ScheduleUpdaterService $updater
     */
    public function __construct($name = null, ScheduleUpdaterService $updater)
    {
        parent::__construct($name);
        $this->updater = $updater;

    }

    protected static $defaultName = 'mlb:update-schedule';

    protected function configure()
    {
        $this
            ->setDescription('Updatating schedule in DB from fantasydata api')
            ->addArgument('season', InputArgument::OPTIONAL, 'Year of updating season')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);


        try {
            $season = $this->getSeason($input);

            $io->comment("Updating schedule for {$season} season");

            $this->updater->update($season);

            $io->success("Updated without errors");

        } catch (SchedulerUpdaterException $e) {
            $io->warning("Error while updateing: {$e->getMessage()}");
        }
    }

    /**
     * @param InputInterface $input
     * @return int
     * @throws SchedulerUpdaterException
     */
    protected function getSeason(InputInterface $input)
    {
        if ($seasonRaw = $input->getArgument('season')) {
            $options = [
                'min_range' => date("Y") - self::MIN_RANGE_INTERVAL,
                'max_range' => date("Y") + self::MAX_RANGE_INTERVAL,
            ];

            $season = filter_var($seasonRaw, FILTER_VALIDATE_INT, ['options' => $options]);
            if (!$season) {
                throw new SchedulerUpdaterException(
                    "Year of updating season is not valid, or not in range. 
                    Current valid range of seasons {$options['min_range']} - {$options['max_range']}."
                );
            }
        } else {
            $season = (int) date("Y");
        }

        return $season;
    }

}
