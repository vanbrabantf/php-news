<?php declare(strict_types=1);

namespace App\Console\Edition;

use App\Service\Edition\CreatorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    /**
     * @var CreatorService
     */
    private $creator;

    /**
     * GenerateCommand constructor.
     * @param CreatorService $creator
     */
    public function __construct(CreatorService $creator)
    {
        $this->creator = $creator;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('edition:generate')
            ->setDescription('Generates new edition')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $edition = $this->creator->create();

        if (!$edition) {
            $output->writeln('No edition was created :(');

            return 0;
        }

        $output->writeln(sprintf('New edition was created "<info>%s</info>"', $edition->getName()));

        return 0;
    }
}
