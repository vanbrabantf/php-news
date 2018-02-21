<?php

namespace App\Service;

use App\Repository\BlogPostRepository;

class LatestPostsService
{
    /**
     * @var BlogPostRepository
     */
    private $repository;

    /**
     * LatestPostsService constructor.
     * @param BlogPostRepository $repository
     */
    public function __construct(BlogPostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function get()
    {
        return $this->repository->findAll();
    }
}
