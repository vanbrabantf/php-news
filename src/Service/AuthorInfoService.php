<?php

namespace App\Service;

use App\Domain\Blog\Author;

class AuthorInfoService
{
    /**
     * @var array
     */
    private $feeds;

    /**
     * AuthorInfoService constructor.
     * @param array $feeds
     */
    public function __construct(array $feeds)
    {
        $this->feeds = $feeds;
    }

    public function get(string $id): Author
    {
        foreach ($this->feeds as $feed) {
            if ($feed['id'] !== $id) {
                continue;
            }

            return new Author($feed['author'], $feed['twitter'], $feed['facebook']);
        }

        throw new \InvalidArgumentException('Could not find author with the ID');
    }
}
