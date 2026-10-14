<?php

namespace App\Api\V1\Common\DTO;

final class CollectionResponse
{
    /**
     * @param array<mixed> $data
     */
    public function __construct(
        public readonly array $data,
        public readonly PaginationResponse $pagination,
    ) {
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'pagination' => [
                'page' => $this->pagination->page,
                'limit' => $this->pagination->limit,
                'total' => $this->pagination->total,
                'pages' => $this->pagination->pages,
            ],
        ];
    }
}