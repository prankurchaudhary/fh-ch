<?php

namespace App\Api\V1\City\DTO;

use OpenApi\Attributes as OA;
use App\Api\V1\Expert\DTO\ExpertResponse;
use App\Api\V1\Continent\DTO\ContinentResponse;

#[OA\Schema(
    schema: 'CityResponse',
    description: 'Chowzter city'
)]
final class CityResponse
{
    public function __construct(
        #[OA\Property(
            description: 'Pimcore City object ID',
            example: 123
        )]
        public readonly int $id,

        #[OA\Property(
            description: 'City name',
            example: 'Dubai'
        )]
        public readonly string $name,
        #[OA\Property(
            description: 'Country name',
            example: 'India'
        )]
        public readonly string $country,

        #[OA\Property(
            description: 'Latitude',
            example: '123.45'
        )]
        public readonly ?string $latitude,

        #[OA\Property(
            description: 'Longitude',
            example: '123.45'
        )]
        public readonly ?string $longitude,

        #[OA\Property(
            description: 'Zipcode',
            example: '12345'
        )]
        public readonly ?string $zipcode,

        #[OA\Property(
            example: 'https://example.com/images/cities/dubai.jpg',
            nullable: true
        )]
        public readonly ?string $cityPhotoUrl,

        public readonly ?ExpertResponse $expert,

        public readonly ?ContinentResponse $continent,

    ) {
    }
}