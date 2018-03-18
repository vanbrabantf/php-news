<?php

namespace App\Console;

use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TweetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('twitter:tweet')
            ->setDescription('Tweets on Tweeter new tweet')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = new TwitterOAuth('','','','');
        $content = $connection->get("account/verify_credentials");
        $statues = $connection->post("statuses/update", ["status" => "hello world"]);

        var_dump($content);
    }
}
