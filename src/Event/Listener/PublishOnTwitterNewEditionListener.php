<?php

namespace App\Event\Listener;

use App\Event\EditionCreatedEvent;
use App\Service\Integration\PublishOnTwitterService;

class PublishOnTwitterNewEditionListener
{
    /**
     * @var PublishOnTwitterService
     */
    private $service;

    /**
     * PublishOnTwitterNewEditionListener constructor.
     * @param PublishOnTwitterService $service
     */
    public function __construct(PublishOnTwitterService $service)
    {
        $this->service = $service;
    }

    public function onEditionPublished(EditionCreatedEvent $event)
    {
        $this->service->notifyAboutNewEdition($event->getEdition());
    }
}
