<?php

namespace App\Api\V1\City\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

final class CityCacheInvalidator
{
    public function __construct(
        #[Autowire(service: 'pimcore.cache.pool')]
        private readonly TagAwareCacheInterface $cache,
    ) {
    }

    public function invalidate(): void
    {
        $this->cache->invalidateTags([
            'api_chowzter_cities',
            'chowzter_cities',
        ]);
    }
}
