<?php

namespace App\Api\V1\Tag\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TagSummaryResponse',
    description: 'Tag summary'
)]
final class TagSummaryResponse
{
    public function __construct(
        #[OA\Property(example: 1)]
        public readonly int $id,

        #[OA\Property(example: 'Popular')]
        public readonly string $name,

        #[OA\Property(example: 'popular')]
        public readonly string $slug,
    ) {
    }
}