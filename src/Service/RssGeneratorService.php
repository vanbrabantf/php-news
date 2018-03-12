<?php declare(strict_types=1);

namespace App\Service;

use Bhaktaraz\RSSGenerator\Channel;
use Bhaktaraz\RSSGenerator\Feed;
use Bhaktaraz\RSSGenerator\Item;

class RssGeneratorService
{
    /**
     * @var LatestPostsService
     */
    private $latestPosts;
    /**
     * @var string
     */
    private $channelTitle;
    /**
     * @var string
     */
    private $channelDescription;
    /**
     * @var string
     */
    private $channelurl;

    /**
     * RssGeneratorService constructor.
     * @param string $channelTitle
     * @param string $channelDescription
     * @param string $channelurl
     * @param LatestPostsService $latestPosts
     */
    public function __construct(string $channelTitle, string $channelDescription, string $channelurl, LatestPostsService $latestPosts)
    {
        $this->latestPosts = $latestPosts;
        $this->channelTitle = $channelTitle;
        $this->channelDescription = $channelDescription;
        $this->channelurl = $channelurl;
    }

    public function generate()
    {
        $feed = new Feed();
        $channel = (new Channel())
            ->title($this->channelTitle)
            ->description($this->channelDescription)
            ->url($this->channelurl)
            ->appendTo($feed);

        foreach ($this->latestPosts->get() as $blogPost) {
            $item = new Item();
            $item
                ->title($blogPost->getTitle())
                ->url($blogPost->getUrl())
                ->pubDate($blogPost->getPubDate()->getTimestamp())
                ->appendTo($channel);
        }

        return (string)$feed;
    }
}
