<?php

namespace App\Service\Edition;

use App\Domain\Edition;
use App\Entity\BlogPost;
use App\Repository\EditionRepository;

class ListService
{
    /**
     * @var EditionRepository
     */
    private $repository;

    /**
     * ListService constructor.
     * @param EditionRepository $repository
     */
    public function __construct(EditionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return BlogPost[]
     */
    public function get(): array
    {
        return $this->repository->findAllOrdered();
    }
}
