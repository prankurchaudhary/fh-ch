<?php

namespace App\EventSubscriber;

use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Model\DataObject\WebsiteUser;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;


class CacheInvalidationSubscriber implements EventSubscriberInterface
{
    public function __construct(private LoggerInterface $logger) {}

    public static function getSubscribedEvents(): array
    {
        return [
            'pimcore.dataobject.postUpdate' => 'onUpdate',
            'pimcore.dataobject.postAdd' => 'onUpdate',
            'pimcore.dataobject.postDelete' => 'onDelete',
        ];
    }

    public function onUpdate(DataObjectEvent $event): void
    {
        $object = $event->getObject();

        if ($object instanceof Restaurant) {
            \Pimcore\Cache::clearTag('search');
        }

        if ($object instanceof City) {
            \Pimcore\Cache::clearTag('search');
            \Pimcore\Cache::clearTag('browse_cities');
        }
        
        // 👨‍🍳 Expert (WebsiteUser with flag)
        if ($object instanceof WebsiteUser && $object->getIsExpert()) {
            
            // 🔥 Invalidate expert detail page
            \Pimcore\Cache::clearTag('expert_' . $object->getId());

            // 🔥 Invalidate expert list page
            \Pimcore\Cache::clearTag('experts_list');
            
            \Pimcore\Cache::clearTag('search');
        }
    }

    public function onDelete(DataObjectEvent $event): void
    {
        $object = $event->getObject();

        if ($object instanceof WebsiteUser && $object->getIsExpert()) {

            // 🔥 Clear detail page cache
            \Pimcore\Cache::clearTag('expert_' . $object->getId());

            // 🔥 Clear list page
            \Pimcore\Cache::clearTag('experts_list');
            \Pimcore\Cache::clearTag('search');
        }

        if ($object instanceof Restaurant) {
            \Pimcore\Cache::clearTag('search');
        }

        if ($object instanceof City) {
            \Pimcore\Cache::clearTag('search');
            \Pimcore\Cache::clearTag('browse_cities');
        }
    }
}