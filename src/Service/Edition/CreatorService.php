<?php

namespace App\Service\Edition;

use App\Domain\Blog\Post;
use App\Domain\Edition;
use App\Event\EditionCreatedEvent;
use App\Service\AuthorInfoService;
use App\Service\UnPublishedBlogPostsService;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreatorService
{
    /**
     * @var UnPublishedBlogPostsService
     */
    private $unpublished;
    /**
     * @var AuthorInfoService
     */
    private $authorInfo;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * CreatorService constructor.
     * @param UnPublishedBlogPostsService $unpublished
     * @param AuthorInfoService $authorInfo
     * @param EntityManager $entityManager
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(UnPublishedBlogPostsService $unpublished, AuthorInfoService $authorInfo, EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->unpublished = $unpublished;
        $this->authorInfo = $authorInfo;
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function create(): ?Edition
    {
        $editionName = sprintf('New PHP News - %s', date('Y-m-d'));
        $entityPosts = $this->unpublished->get();
        $posts = [];

        $entityEdition = new \App\Entity\Edition($editionName);
        $this->entityManager->persist($entityEdition);

        foreach ($entityPosts as $blogEntity) {
            $blogEntity->setEdition($entityEdition);
            $this->entityManager->persist($blogEntity);

            $author = $this->authorInfo->get($blogEntity->getBlogId());
            $posts[] = new Post($blogEntity->getTitle(), $blogEntity->getUrl(), $blogEntity->getPubDate(), $author);
        }

        if (empty($posts)) {
            $this->entityManager->clear();
            return null;
        }

        $this->entityManager->flush();
        $edition = new Edition($editionName, $posts);

        $this->eventDispatcher->dispatch('edition.published', new EditionCreatedEvent($edition));

        return $edition;
    }
}
