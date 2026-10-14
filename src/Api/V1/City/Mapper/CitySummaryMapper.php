<?php

namespace App\Api\V1\City\Mapper;

use App\Api\V1\City\DTO\CitySummaryResponse;
use Pimcore\Model\DataObject\City;

final class CitySummaryMapper
{
    public function map(?City $city): ?CitySummaryResponse
    {
        if ($city === null) {
            return null;
        }

        return new CitySummaryResponse(
            id: $city->getId(),
            name: $city->getName(),
            slug: $city->getSlug(),
        );
    }
}