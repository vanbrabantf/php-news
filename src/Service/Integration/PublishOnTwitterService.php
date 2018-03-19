<?php

namespace App\Service\Integration;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Domain\Edition;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class PublishOnTwitterService
{
    /**
     * @var TwitterOAuth
     */
    private $twitter;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * PublishOnTwitterService constructor.
     * @param TwitterOAuth $twitter
     * @param UrlGeneratorInterface $router
     */
    public function __construct(TwitterOAuth $twitter, UrlGeneratorInterface $router)
    {
        $this->twitter = $twitter;
        $this->urlGenerator = $router;
    }

    public function notifyAboutNewEdition(Edition $edition)
    {
        $status = sprintf('New edition is published! "%s". Happy reading! :) %s', $edition->getName(), 'https://php-news.com');

        $this->twitter->post("statuses/update", ["status" => $status]);
    }
}
