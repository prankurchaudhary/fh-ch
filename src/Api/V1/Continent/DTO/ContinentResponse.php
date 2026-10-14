<?php

namespace App\Api\V1\Continent\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ContinentResponse',
    description: 'Continent information'
)]
final class ContinentResponse
{
    public function __construct(
        #[OA\Property(
            example: 'Europe'
        )]
        public readonly string $name,

        #[OA\Property(
            example: 'europe'            
        )]
        public readonly ?string $slug,
    ) {
    }
}