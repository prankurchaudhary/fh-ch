<?php

namespace App\Api\V1\Category\Mapper;

use App\Api\V1\Category\DTO\CategorySummaryResponse;
use Pimcore\Model\DataObject\FoodCategory;

final class CategorySummaryMapper
{
    public function map(?FoodCategory $category): ?CategorySummaryResponse
    {
        if ($category === null) {
            return null;
        }

        return new CategorySummaryResponse(
            id: $category->getId(),
            name: $category->getCategoryName(),
            slug: $category->getSlug(),
        );
    }
}