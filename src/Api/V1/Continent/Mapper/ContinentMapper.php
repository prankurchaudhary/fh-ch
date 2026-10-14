<?php

namespace App\Api\V1\Continent\Mapper;

use App\Api\V1\Continent\DTO\ContinentResponse;
use Pimcore\Model\DataObject\Continent;


final class ContinentMapper
{
    public function map(?Continent $continent): ?ContinentResponse
    {
        if ($continent === null) {
            return null;
        }

        return new ContinentResponse(
            name: $continent->getName(),
            slug: $continent->getSlug()
        );
    }
}