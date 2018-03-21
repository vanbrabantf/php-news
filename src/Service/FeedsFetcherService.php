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

            if ($xml->channel->item instanceof \SimpleXMLElement) {
                $output->writeln(sprintf('Found <info>%s</info> entries', count($xml->channel->item)));

                foreach ($xml->channel->item as $entry) {
                    $postsAdded += $this->addRss2Entry($entry, $blogId);
                }
            } else {
                $output->writeln(sprintf('Found <info>%s</info> entries', count($xml->entry)));

                foreach ($xml->entry as $entry) {
                    $postsAdded += $this->addAtomEntry($entry, $blogId);
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
    public function addRss2Entry($entry, $blogId): int
    {
        $found = $this->em->getRepository(BlogPost::class)
            ->findBy([
                'url' => (string)$entry->link,
            ]);

        if (count($found)) {
            return 0;
        }

        $pubDate = new \DateTimeImmutable((string)$entry->pubDate);
        $post = new BlogPost((string)$entry->title, $blogId, (string)$entry->link, $pubDate,null);

        try {
            $this->em->persist($post);
            $this->em->flush();
            return 1;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return 0;
    }

    public function addAtomEntry($entry, $blogId): int
    {
        $link = (string)$entry->link['href'];

        $found = $this->em->getRepository(BlogPost::class)
            ->findBy([
                'url' => $link,
            ]);

        if (count($found)) {
            return 0;
        }

        $pubDate = new \DateTimeImmutable((string)$entry->pubDate);
        $post = new BlogPost((string)$entry->title, $blogId, $link, $pubDate,null);

        try {
            $this->em->persist($post);
            $this->em->flush();
            return 1;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return 0;
    }
}
