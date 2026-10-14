<?php

namespace App\EventListener;

use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Model\DataObject\RestaurantLike;
use Pimcore\Model\DataObject\RestaurantLike\Listing;

class RestaurantLikeListener
{
    public function onPreSave(DataObjectEvent $event): void
    {
        $object = $event->getObject();

        // only for RestaurantLike
        if (!$object instanceof RestaurantLike) {
            return;
        }

        $user = $object->getUser();
        $restaurant = $object->getRestaurant();

        // basic validation
        if (!$user || !$restaurant) {
            throw new \Exception('User and Restaurant are required to like.');
        }

        // check for existing like
        $listing = new Listing();
        $listing->setCondition(
            'user__id = ? AND restaurant__id = ? AND o_id != ?',
            [
                $user->getId(),
                $restaurant->getId(),
                $object->getId() ?? 0
            ]
        );

        if ($listing->count() > 0) {
            throw new \Exception('Restaurant already liked by this user.');
        }

        // auto-set timestamp
        if (!$object->getLikedAt()) {
            $object->setLikedAt(new \DateTime());
        }

        // auto-publish
        $object->setPublished(true);
    }
}
