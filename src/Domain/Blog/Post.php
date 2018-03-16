<?php

namespace App\Domain\Blog;

class Post
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    /**
     * @var \DateTimeImmutable
     */
    private $pubDate;

    /**
     * @var Author
     */
    private $author;

    /**
     * Post constructor.
     * @param string $title
     * @param string $url
     * @param \DateTimeImmutable $pubDate
     * @param Author $author
     */
    public function __construct(string $title, string $url, \DateTimeImmutable $pubDate, Author $author)
    {
        $this->title = $title;
        $this->url = $url;
        $this->pubDate = $pubDate;
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getPubDate(): \DateTimeImmutable
    {
        return $this->pubDate;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }
}
