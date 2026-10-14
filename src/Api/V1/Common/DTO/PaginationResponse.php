<?php

namespace App\Api\V1\Common\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(
    description: 'Pagination information'
)]
final class PaginationResponse
{
    public function __construct(
        #[OA\Property(
            example: 1,
            minimum: 1
        )]
        public readonly int $page,

        #[OA\Property(
            example: 20,
            minimum: 1,
            maximum: 100
        )]
        public readonly int $limit,

        #[OA\Property(
            example: 125,
            minimum: 0
        )]
        public readonly int $total,

        #[OA\Property(
            example: 7,
            minimum: 0
        )]
        public readonly int $pages,
    ) {
    }
}