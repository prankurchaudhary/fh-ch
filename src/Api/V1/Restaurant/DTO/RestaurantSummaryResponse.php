<?php

namespace App\Api\V1\Restaurant\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RestaurantSummaryResponse'
)]
final class RestaurantSummaryResponse
{
    public function __construct(
        #[OA\Property(example: 25)]
        public readonly int $id,

        #[OA\Property(example: 'Taj Restaurant')]
        public readonly string $name,

        #[OA\Property(example: 'taj-restaurant')]
        public readonly string $slug,
        public readonly bool $liked = false,
    ) {
    }
}