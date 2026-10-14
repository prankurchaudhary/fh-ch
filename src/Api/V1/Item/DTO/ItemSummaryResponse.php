<?php

namespace App\Api\V1\Item\DTO;

use App\Api\V1\Category\DTO\CategorySummaryResponse;
use App\Api\V1\City\DTO\CitySummaryResponse;
use App\Api\V1\Restaurant\DTO\RestaurantSummaryResponse;
use App\Api\V1\Tag\DTO\TagSummaryResponse;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ItemSummaryResponse',
    description: 'Item API Summary response'
)]
final class ItemSummaryResponse
{
    public function __construct(
        #[OA\Property(example: 101)]
        public readonly int $id,

        #[OA\Property(example: 'Butter Chicken')]
        public readonly string $itemName,

        #[OA\Property(example: 'butter-chicken')]
        public readonly string $slug,


        #[OA\Property(nullable: true)]
        public readonly ?CategorySummaryResponse $category,

        #[OA\Property(nullable: true)]
        public readonly ?CitySummaryResponse $city,

        #[OA\Property(
            type: 'array',
            items: new OA\Items(
                ref: TagSummaryResponse::class
            )
        )]
        public readonly array $tags,
    ) {
    }
}