<?php

namespace App\Api\V1\Category\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CategorySummaryResponse'
)]
final class CategorySummaryResponse
{
    public function __construct(
        #[OA\Property(example: 5)]
        public readonly int $id,

        #[OA\Property(example: 'Main Course')]
        public readonly string $name,

        #[OA\Property(example: 'main-course')]
        public readonly string $slug,
    ) {
    }
}