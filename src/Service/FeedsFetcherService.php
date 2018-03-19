<?php

namespace App\Service;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Output\OutputInterface;

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

    public function start(OutputInterface $output)
    {
        foreach ($this->feeds as $feed) {
            $content = file_get_contents($feed['feedUrl']);
            $xml = new \SimpleXmlElement($content);
            $blogId = $feed['id'];

            $output->writeln(sprintf('Fetching blog posts from <info>%s</info>', $blogId));
            $postsAdded = 0;

            if (is_array($xml->channel->item)) {
                foreach($xml->channel->item as $entry) {
                    $postsAdded += $this->addEntry($entry, $blogId);
                }
            } else {
                if ($xml->channel->item instanceof \SimpleXMLElement) {
                    $postsAdded += $this->addEntry($xml->channel->item, $blogId);
                }
            }

            $output->writeln(sprintf('Added %s posts', $postsAdded));
        }
    }

    /**
     * @param $entry
     * @param $blogId
     * @return int
     */
    public function addEntry($entry, $blogId): int
    {
        $found = $this->em->getRepository(BlogPost::class)
            ->findBy([
                'url' => $entry->link,
            ]);

        if (count($found)) {
            return 0;
        }

        $pubDate = new \DateTimeImmutable((string)$entry->pubDate);
        $post = new BlogPost($entry->title, $blogId, $entry->link, $pubDate,null);

        try {
            $this->em->persist($post);
            $this->em->flush();
            return 1;
        } catch (\Exception $e) {
        }

        return 0;
    }
}
