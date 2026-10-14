<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class CacheTagService
{
    public function addTags(Response $response, array $tags): void
    {
        $existing = $response->headers->get('X-Pimcore-Cache-Tags');

        $allTags = $existing ? explode(',', $existing) : [];

        $allTags = array_merge($allTags, $tags);

        $response->headers->set(
            'X-Pimcore-Cache-Tags',
            implode(',', array_unique($allTags))
        );
    }
}

