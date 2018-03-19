<?php

namespace App\Service;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManager;

class FeedsFetcherService
{
    /**
     * @var array
     */
    private $feeds = [];

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * FeedsFetcherService constructor.
     * @param array $feeds
     * @param EntityManager $em
     */
    public function __construct(array $feeds, EntityManager $em)
    {
        $this->feeds = $feeds;
        $this->em = $em;
    }

    public function start()
    {
        foreach ($this->feeds as $feed) {
            $content = file_get_contents($feed['feedUrl']);
            $xml = new \SimpleXmlElement($content);
            $blogId = $feed['id'];

            if (!is_array($xml->channel->item)) {
                if ($xml->channel->item instanceof \SimpleXMLElement) {
                    $this->addEntry($xml->channel->item, $blogId);
                }

                continue;
            }

            foreach($xml->channel->item as $entry) {
                $this->addEntry($entry, $blogId);
            }
        }
    }

    /**
     * @param $entry
     * @param $blogId
     */
    public function addEntry($entry, $blogId): void
    {
        $found = $this->em->getRepository(BlogPost::class)
            ->findBy([
                'url' => $entry->link,
            ]);

        if (count($found)) {
            return;
        }

        $pubDate = new \DateTimeImmutable((string)$entry->pubDate);
        $post = new BlogPost($entry->title, $blogId, $entry->link, $pubDate,null);

        try {
            $this->em->persist($post);
            $this->em->flush();
        } catch (\Exception $e) {
        }
    }
}
