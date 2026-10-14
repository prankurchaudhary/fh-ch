<?php

namespace App\Api\V1\City\EventSubscriber;

use App\Api\V1\City\Service\CityCacheInvalidator;
use Pimcore\Event\DataObjectEvents;
use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Model\DataObject\City;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class CityCacheSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly CityCacheInvalidator $cacheInvalidator,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            DataObjectEvents::POST_ADD => 'onCityChanged',
            DataObjectEvents::POST_UPDATE => 'onCityChanged',
            DataObjectEvents::POST_DELETE => 'onCityChanged',
        ];
    }

    public function onCityChanged(DataObjectEvent $event): void
    {
        if (!$event->getObject() instanceof City) {
            return;
        }

        $this->cacheInvalidator->invalidate();
    }
}
