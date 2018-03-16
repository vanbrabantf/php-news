<?php

namespace App\Domain;

use App\Domain\Blog\Post;

class Edition
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Post[]
     */
    private $posts = [];

    /**
     * Edition constructor.
     * @param string $name
     * @param Post[] $posts
     */
    public function __construct(string $name, array $posts)
    {
        $this->name = $name;
        $this->posts = $posts;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

}
