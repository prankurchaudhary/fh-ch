<?php

namespace App\Api\V1\Expert\DTO;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ExpertResponse',
    description: 'Expert information'
)]
final class ExpertResponse
{
    public function __construct(
        #[OA\Property(
            example: 'John Doe'
        )]
        public readonly string $name,

        #[OA\Property(
            example: '/experts/john-doe',
            nullable: true
        )]
        public readonly ?string $profileUrl,
    ) {
    }
}