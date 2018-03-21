<?php

namespace App\Domain;

use App\Domain\Blog\Post;

class Edition
{
    /**
     * @var int
     */
    private $id;

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
     * @param int $id
     * @param string $name
     * @param Post[] $posts
     */
    public function __construct(int $id, string $name, array $posts)
    {
        $this->id = $id;
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
