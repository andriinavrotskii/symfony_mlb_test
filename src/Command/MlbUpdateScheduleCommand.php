<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MlbUpdateScheduleCommand extends Command
{
    const MIN_RANGE_INTERVAL = 50;
    const MAX_RANGE_INTERVAL = 50;

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

        if ($seasonRaw = $input->getArgument('season')) {
            $options = [
                'min_range' => date("Y") - self::MIN_RANGE_INTERVAL,
                'max_range' => date("Y") + self::MAX_RANGE_INTERVAL,
            ];

            $season = filter_var($seasonRaw, FILTER_VALIDATE_INT, ['options' => $options]);
            if (!$season) {
                $io->warning("Year of updating season is not valid, or not in range. Current valid range of seasons {$options['min_range']} - {$options['max_range']}.");
            }
        } else {
            $season = date("Y");
        }

        $io->comment("Updating schedule for {$season} season");

        $this->updateSchedule($season);
    }


    protected function updateSchedule($season)
    {

    }

}
