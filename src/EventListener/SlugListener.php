<?php

namespace App\EventListener;

// src/EventListener/SlugListener.php

use Pimcore\Event\DataObjectEvents;
use Pimcore\Event\Model\DataObjectEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Cocur\Slugify\Slugify;

class SlugListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            DataObjectEvents::PRE_UPDATE => 'onSave',
            DataObjectEvents::PRE_ADD => 'onSave',
        ];
    }

    public function onSave(DataObjectEvent $event)
    {
        $object = $event->getObject();
        $slugify = new Slugify();

        if ($object instanceof \Pimcore\Model\DataObject\City && !$object->getSlug()) {
            //$object->setSlug($slugify->slugify($object->getName()));
        }
        if ($object instanceof \Pimcore\Model\DataObject\Tag && !$object->getSlug()) {
            $object->setSlug($slugify->slugify($object->getTagName()));
        }

        if ($object instanceof \Pimcore\Model\DataObject\Restaurant && !$object->getSlug()) {
            $object->setSlug($slugify->slugify($object->getName()));
        }

        if ($object instanceof \Pimcore\Model\DataObject\Item && !$object->getSlug()) {
            $object->setSlug($slugify->slugify($object->getItemName()));
        }
        if ($object instanceof \Pimcore\Model\DataObject\Continent && !$object->getSlug()) {
           // $object->setSlug($slugify->slugify($object->getName()));
        }

        if ($object instanceof \Pimcore\Model\DataObject\Restaurant && !$object->getDishSlug()) {
            $object->setDishSlug($slugify->slugify($object->getDishName()));
        }

        if ($object instanceof \Pimcore\Model\DataObject\WebsiteUser && !$object->getHandle()) {
            $object->setHandle($slugify->slugify($object->getFirstName().'-'.$object->getLastName()));
        }
        if ($object instanceof \Pimcore\Model\DataObject\FoodCategory && !$object->getSlug()) {
            $object->setSlug($slugify->slugify($object->getCategoryName()));
        }
        if ($object instanceof \Pimcore\Model\DataObject\Blog) {
        if (!$object->getSlug()) {            
            $object->setSlug(
                $slugify->slugify($event->getObject()->getTitle())
            );
        }
    }
    }
}
