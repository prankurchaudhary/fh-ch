<?php

namespace App\Api\V1\Restaurant\DTO;
use App\Api\V1\Item\DTO\ItemResponse;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RestaurantResponse'
)]
final class RestaurantResponse
{
    public function __construct(
        #[OA\Property(example: 25)]
        public readonly int $id,

        #[OA\Property(example: 'Taj Restaurant')]
        public readonly string $name,

        #[OA\Property(example: 'taj-restaurant')]
        public readonly string $slug,

        // public readonly bool $liked = false,

        #[OA\Property(nullable: true)]
        #[OA\Property(
            type: 'array',
            items: new OA\Items(
                ref: ItemResponse::class
            )
        )]
        public readonly array $items,
    ) {
    }
}