<?php

namespace App\Domain\Blog;

class Author
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $twitter;

    /**
     * @var string|null
     */
    private $facebook;

    /**
     * Author constructor.
     * @param string $name
     * @param string $twitter
     * @param string $facebook
     */
    public function __construct(string $name, string $twitter = null, string $facebook = null)
    {
        $this->name = $name;
        $this->twitter = $twitter;
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * @return null|string
     */
    public function getFacebook(): ?string
    {
        return $this->facebook;
    }
}
