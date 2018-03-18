<?php

namespace App\Service;

use App\Domain\Blog\Author;
use App\Domain\Blog\Post;
use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;

class UnPublishedBlogPostsService
{
    /**
     * @var BlogPostRepository
     */
    private $repository;

    /**
     * UnPublishedBlogPostsService constructor.
     * @param BlogPostRepository $repository
     */
    public function __construct(BlogPostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return BlogPost[]
     */
    public function get(): array
    {
        return $this->repository->finNotPublished();
    }
}
