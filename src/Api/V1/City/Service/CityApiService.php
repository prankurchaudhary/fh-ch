<?php

namespace App\Api\V1\City\Service;

use App\Api\V1\Common\DTO\CollectionResponse;
use App\Api\V1\Common\DTO\PaginationResponse;
use App\Api\V1\Common\Request\PaginationRequest;
use App\Api\V1\City\Mapper\CityMapper;
use Pimcore\Model\DataObject\City;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;


final class CityApiService
{
    private const CACHE_TTL = 3600;
    private const CACHE_TAG = 'api_chowzter_cities';

    
    public function __construct(
        private readonly CityMapper $cityMapper,

        #[Autowire(service: 'pimcore.cache.pool')]
        private readonly TagAwareCacheInterface $cache,

        private readonly LoggerInterface $logger,
        ) {
    }

    
public function getCities(
    PaginationRequest $pagination
): CollectionResponse {
    $page = $pagination->page;
    $limit = $pagination->limit;

    $cacheKey = sprintf(
        'chowzter_cities_v1_page_%d_limit_%d',
        $page,
        $limit
    );

    $cacheMiss = false;

    $result = $this->cache->get(
        $cacheKey,
        function (ItemInterface $item) use (
            $pagination,
            $page,
            $limit,
            &$cacheMiss
        ): CollectionResponse {
            $cacheMiss = true;

            $item->expiresAfter(self::CACHE_TTL);
            $item->tag([self::CACHE_TAG]);

            $listing = new City\Listing();

            $listing->setOrderKey('name');
            $listing->setOrder('ASC');

            $total = $listing->getTotalCount();

            $listing->setOffset($pagination->getOffset());
            $listing->setLimit($limit);

            $data = [];

            foreach ($listing as $city) {
                $data[] = $this->cityMapper->map($city);
            }

            $pages = $limit > 0
                ? (int) ceil($total / $limit)
                : 0;

            return new CollectionResponse(
                data: $data,
                pagination: new PaginationResponse(
                    page: $page,
                    limit: $limit,
                    total: $total,
                    pages: $pages,
                ),
            );
        }
    );

    $this->logger->info('City API cache check', [
        'key' => $cacheKey,
        'status' => $cacheMiss ? 'MISS' : 'HIT',
    ]);

    error_log(sprintf(
        '[CITY_CACHE] key=%s status=%s',
        $cacheKey,
        $cacheMiss ? 'MISS' : 'HIT'
    ));

    return $result;
}

}
