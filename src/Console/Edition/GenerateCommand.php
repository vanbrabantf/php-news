<?php declare(strict_types=1);

namespace App\Console\Edition;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('edition:generate')
            ->setDescription('Generates new edition')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
