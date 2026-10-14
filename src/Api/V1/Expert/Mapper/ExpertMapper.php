<?php

namespace App\Api\V1\Expert\Mapper;

use App\Api\V1\Expert\DTO\ExpertResponse;
use Pimcore\Model\DataObject\WebsiteUser;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


final class ExpertMapper
{
     public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }
    public function map(?WebsiteUser $expert): ?ExpertResponse
    {
        if ($expert === null) {
            return null;
        }

        return new ExpertResponse(
            name: $expert->getFirstName(),
            profileUrl: $this->urlGenerator->generate(
                'expert_detail',
                [
                    'handle' => $expert->getHandle(),
                ]
                
            ),
        );
    }
}