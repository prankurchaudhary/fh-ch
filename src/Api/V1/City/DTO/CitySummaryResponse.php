<?php

namespace App\Api\V1\City\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CitySummaryResponse'
)]
final class CitySummaryResponse
{
    public function __construct(
        #[OA\Property(example: 10)]
        public readonly int $id,

        #[OA\Property(example: 'Dubai')]
        public readonly string $name,

        #[OA\Property(example: 'dubai')]
        public readonly string $slug,
    ) {
    }
}