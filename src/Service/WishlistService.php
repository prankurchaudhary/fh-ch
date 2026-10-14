<?php

namespace App\Service;

use Pimcore\Model\DataObject\Restaurant;
use Pimcore\Model\DataObject\RestaurantWishlist;
use Pimcore\Model\DataObject\WebsiteUser;
use Pimcore\Model\DataObject\Folder;

class WishlistService
{
    public function addToWishlist(WebsiteUser $user, Restaurant $restaurant): bool
    {
        $existing = new RestaurantWishlist\Listing();

        $existing->setCondition(
            'user__id = ? AND restaurant__id = ?',
            [$user->getId(), $restaurant->getId()]
        );

        if ($existing->count() > 0) {
            return false;
        }

        $wishlist = new RestaurantWishlist();

        $wishlist->setKey(
            'wishlist-' .
            $user->getId() .
            '-' .
            $restaurant->getId()
        );
        $wishlistFolder = Folder::getByPath('/RestaurantWishList');

        $wishlist->setParent($wishlistFolder); // Wishlist folder

        $wishlist->setUser($user);
        $wishlist->setRestaurant($restaurant);
        $wishlist->setPublished(true);
        $wishlist->setCreatedAt(\Carbon\Carbon::now());
        //$wishlist->setCreatedAt(new \DateTime());

        $wishlist->save();

        return true;
    }

    public function removeFromWishlist(WebsiteUser $user, Restaurant $restaurant): bool
    {
        $listing = new RestaurantWishlist\Listing();

        $listing->setCondition(
            'user__id = ? AND restaurant__id = ?',
            [$user->getId(), $restaurant->getId()]
        );

        foreach ($listing as $item) {
            $item->delete();
        }

        return true;
    }

    public function isWishlisted(WebsiteUser $user, Restaurant $restaurant): bool
    {
        $listing = new RestaurantWishlist\Listing();

        $listing->setCondition(
            'user__id = ? AND restaurant__id = ?',
            [$user->getId(), $restaurant->getId()]
        );

        return $listing->count() > 0;
    }
}