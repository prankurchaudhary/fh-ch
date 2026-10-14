<?php

namespace App\EventListener;

use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Model\DataObject\BlogPost;
use Pimcore\Event\DataObjectEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Carbon\Carbon;

class BlogPostPublishedDateListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            DataObjectEvents::PRE_UPDATE => 'onPreUpdate',
            DataObjectEvents::PRE_ADD    => 'onPreAdd',
        ];
    }

    public function onPreAdd(DataObjectEvent $event): void
    {
        $this->handlePublishedDate($event);
    }

    public function onPreUpdate(DataObjectEvent $event): void
    {
        $this->handlePublishedDate($event);
    }

    private function handlePublishedDate(DataObjectEvent $event): void
    {
        $object = $event->getObject();

        if (!$object instanceof BlogPost) {
            return;
        }

        // Only if object is published
        if (!$object->isPublished()) {
            return;
        }

        // Set publishedDate only once
        if ($object->getPublishedDate() === null) {
            $object->setPublishedDate(Carbon::now());
        }
    }
}
