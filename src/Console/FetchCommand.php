<?php

namespace App\Console;

use App\Service\FeedsFetcherService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('feeds:fetch')
            ->setDescription('Fetches all feeds')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fetcher = $this->getContainer()->get(FeedsFetcherService::class);
        $fetcher->start();
    }
}
