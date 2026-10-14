<?php

namespace App\Api\V1\City\Mapper;

use App\Api\V1\City\DTO\CityResponse;
use Pimcore\Model\DataObject\City;
use App\Api\V1\Expert\Mapper\ExpertMapper;
use App\Api\V1\Continent\Mapper\ContinentMapper;



final class CityMapper
{
    public function __construct(
        private readonly ExpertMapper $expertMapper, private readonly ContinentMapper $continentMapper
    ) {
    }

    public function map(City $city): CityResponse
    {
        return new CityResponse(
            id: $city->getId(),
            name: $city->getName(),
            latitude: $city->getLatitude(),
            longitude: $city->getLongitude(),
            zipcode: $city->getZipcode(),
            country: $city->getCountry(),
            cityPhotoUrl: $city->getCityPhoto()?->getThumbnail('city-corousal'),
            expert: $this->expertMapper->map(
                $city->getExpert()
            ),
            continent: $this->continentMapper->map($city->getContinent())
        );
    }
}