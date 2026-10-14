<?php

namespace App\Api\V1\Tag\Mapper;

use App\Api\V1\Tag\DTO\TagSummaryResponse;
use Pimcore\Model\DataObject\Tag;

final class TagSummaryMapper
{
    public function map(?Tag $tag): ?TagSummaryResponse
    {
        if ($tag === null) {
            return null;
        }

        return new TagSummaryResponse(
            id: $tag->getId(),
            name: $tag->getTagName(),
            slug: $tag->getSlug(),
        );
    }
}