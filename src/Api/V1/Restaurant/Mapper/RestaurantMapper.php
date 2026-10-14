<?php

namespace App\Api\V1\Restaurant\Mapper;

use App\Api\V1\Restaurant\DTO\RestaurantResponse;
use Pimcore\Model\DataObject\Restaurant;
use App\Api\V1\Item\Mapper\ItemMapper;

final class RestaurantMapper
{
    public function __construct(
        private readonly ItemMapper $itemMapper
    ) {
    }
    public function map(?Restaurant $restaurant): ?RestaurantResponse
    {
        if ($restaurant === null) {
            return null;
        }
        $items = [];

        foreach ($restaurant->getItems() ?? [] as $item) {
            $items[] = $this->itemMapper->map($item);
        }

        return new RestaurantResponse(
            id: $restaurant->getId(),
            name: $restaurant->getName(),
            slug: $restaurant->getSlug(),
            items: $items,
        );
    }
}