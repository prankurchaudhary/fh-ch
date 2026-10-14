<?php

namespace App\Api\V1\Restaurant\Mapper;

use App\Api\V1\Restaurant\DTO\RestaurantSummaryResponse;
use Pimcore\Model\DataObject\Restaurant;

final class RestaurantSummaryMapper
{
    public function map(?Restaurant $restaurant, bool $liked = false): ?RestaurantSummaryResponse
    {
        if ($restaurant === null) {
            return null;
        }

        return new RestaurantSummaryResponse(
            id: $restaurant->getId(),
            name: $restaurant->getName(),
            slug: $restaurant->getSlug(),
            liked: $liked,
        );
    }
}