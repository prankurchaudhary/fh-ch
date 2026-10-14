<?php

namespace App\Api\V1\RestaurantLike\DTO;

use App\Api\V1\Restaurant\DTO\RestaurantSummaryResponse;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RestaurantLikeResponse',
    description: 'Restaurant liked by the authenticated user'
)]
final class RestaurantLikeResponse
{
    public function __construct(
        #[OA\Property(
            description: 'Pimcore RestaurantLike object ID',
            example: 101
        )]
        public readonly int $id,

        #[OA\Property(
            ref: '#/components/schemas/RestaurantSummaryResponse'
        )]
        public readonly ?RestaurantSummaryResponse $restaurant,

        #[OA\Property(
            description: 'Date when the restaurant was liked',
            example: '2026-10-06 18:30:00',
            nullable: true
        )]
        public readonly ?string $createdAt,
    ) {
    }
}