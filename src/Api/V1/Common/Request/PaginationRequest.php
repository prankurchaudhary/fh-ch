<?php

namespace App\Api\V1\Common\Request;

use Symfony\Component\HttpFoundation\Request;

final class PaginationRequest
{
    private const DEFAULT_PAGE = 1;
    private const DEFAULT_LIMIT = 20;
    private const MAX_LIMIT = 100;

    public function __construct(
        public readonly int $page,
        public readonly int $limit,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $page = max(
            1,
            $request->query->getInt('page', self::DEFAULT_PAGE)
        );

        $limit = $request->query->getInt('limit', self::DEFAULT_LIMIT);

        $limit = max(1, min(self::MAX_LIMIT, $limit));

        return new self(
            page: $page,
            limit: $limit
        );
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->limit;
    }
}