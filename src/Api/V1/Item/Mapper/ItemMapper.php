<?php

namespace App\Api\V1\Item\Mapper;

use App\Api\V1\Category\Mapper\CategorySummaryMapper;
use App\Api\V1\City\Mapper\CitySummaryMapper;
use App\Api\V1\Item\DTO\ItemResponse;
use App\Api\V1\Restaurant\Mapper\RestaurantSummaryMapper;
use App\Api\V1\Tag\Mapper\TagSummaryMapper;
use Pimcore\Model\DataObject\Item;

final class ItemMapper
{
    public function __construct(
        private readonly RestaurantSummaryMapper $restaurantMapper,
        private readonly CategorySummaryMapper $categoryMapper,
        private readonly CitySummaryMapper $cityMapper,
        private readonly TagSummaryMapper $tagMapper,
    ) {
    }

    public function map(
        Item $item,
        array $likedRestaurantIds = []
    ): ItemResponse
    {
        $tags = [];

        foreach ($item->getTags() ?? [] as $tag) {
            $tags[] = $this->tagMapper->map($tag);
        }
       $restaurant = $item->getRestaurant();

        $liked = $restaurant !== null
            && isset($likedRestaurantIds[(int) $restaurant->getId()]);

        return new ItemResponse(
            id: $item->getId(),
            itemName: $item->getItemName(),
            slug: $item->getSlug(),
            restaurant: $this->restaurantMapper->map(
                $item->getRestaurant(), $liked
            ),
            category: $this->categoryMapper->map(
                $item->getCategory()
            ),
            city: $this->cityMapper->map(
                $item->getCity()
            ),
            tags: $tags,
            
        );
    }
}