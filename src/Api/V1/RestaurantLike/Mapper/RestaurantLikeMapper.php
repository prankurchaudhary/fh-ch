<?php

namespace App\Api\V1\RestaurantLike\Mapper;

use App\Api\V1\Restaurant\Mapper\RestaurantSummaryMapper;
use App\Api\V1\RestaurantLike\DTO\RestaurantLikeResponse;
use Pimcore\Model\DataObject\Restaurant;
use Pimcore\Model\DataObject\RestaurantLike;

final class RestaurantLikeMapper
{
    public function __construct(
        private readonly RestaurantSummaryMapper $restaurantSummaryMapper,
    ) {
    }

    public function map(RestaurantLike $restaurantLike): RestaurantLikeResponse
    {
        $restaurant = $restaurantLike->getRestaurant();

        return new RestaurantLikeResponse(
            id: $restaurantLike->getId(),

            restaurant: $restaurant instanceof Restaurant
                ? $this->restaurantSummaryMapper->map($restaurant)
                : null,

            createdAt: $restaurantLike->getCreatedAt()?->format('Y-m-d H:i:s'),
        );
    }
}