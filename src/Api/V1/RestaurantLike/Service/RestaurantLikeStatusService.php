<?php

namespace App\Api\V1\RestaurantLike\Service;

use Pimcore\Model\DataObject\RestaurantLike;
use Pimcore\Model\DataObject\WebsiteUser;

final class RestaurantLikeStatusService
{
    /**
     * Return restaurant IDs liked by the given user.
     *
     * @return int[]
     */
    public function getLikedRestaurantIds(WebsiteUser $user): array
    {
        $listing = new RestaurantLike\Listing();

        $listing->setCondition(
            'user__id = ?',
            [$user->getId()]
        );

        $restaurantIds = [];

        foreach ($listing as $like) {
            $restaurant = $like->getRestaurant();

            if ($restaurant !== null) {
                //$restaurantIds[] = $restaurant->getId();
                $restaurantIds[$restaurant->getId()] = true;
            }
        }

        return $restaurantIds;
    }
}