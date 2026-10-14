<?php

namespace App\Api\V1\Restaurant\Service;

use App\Api\V1\Common\DTO\CollectionResponse;
use App\Api\V1\Common\DTO\PaginationResponse;
use App\Api\V1\Common\Request\PaginationRequest;
use App\Api\V1\Restaurant\Mapper\RestaurantMapper;
use Pimcore\Model\DataObject\Restaurant;


final class RestaurantApiService
{
    public function __construct(
    private readonly RestaurantMapper $restaurantMapper
    ) {
    }

    /**
     * Return all restaurants with pagination.
     */
    public function list(
        PaginationRequest $pagination
    ): CollectionResponse {
        
        $listing = new Restaurant\Listing();

        $listing->setOrderKey('name');
        $listing->setOrder('ASC');

        $total = $listing->getTotalCount();

        $listing->setOffset($pagination->getOffset());
        $listing->setLimit($pagination->limit);

        $data = [];

        foreach ($listing as $restaurant) {

            $data[] = $this->restaurantMapper->map(
                $restaurant,                
            );
        }

        $pages = $pagination->limit > 0
            ? (int) ceil($total / $pagination->limit)
            : 0;

        return new CollectionResponse(
            data: $data,
            pagination: new PaginationResponse(
                page: $pagination->page,
                limit: $pagination->limit,
                total: $total,
                pages: $pages,
            ),
        );
    }

    /**
     * Return restaurants belonging to a specific city with pagination.
     */
    public function listByCity(
        int $cityId,
        int $page = 1,
        int $limit = 20
    ): array {
       
        $listing = new Restaurant\Listing();

        $listing->setCondition(
            'city__id = ?',
            [$cityId]
        );

        $total = $listing->getTotalCount();
        

        $offset = ($page - 1) * $limit;

        $listing->setOffset($offset);
        $listing->setLimit($limit);
        $listing->setOrderKey('id');
        $listing->setOrder('ASC');

        foreach ($listing as $restaurant) {

            $data[] = $this->restaurantMapper->map(
                    $restaurant
                );
        }

        return [
            'data' => $data,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'pages' => $limit > 0
                    ? (int) ceil($total / $limit)
                    : 0,
            ],
        ];
    }

    /**
     * Return restaurants belonging to a specific city with pagination.
     */
    public function getById(
        int $id,
        int $page = 1,
        int $limit = 20
    ): array {
       
        $restaurant = Restaurant::getById($id);
        if (!$restaurant instanceof Restaurant) {
             return [
            'data' => [],
        ];
        }

        $data = $this->restaurantMapper->map(
                    $restaurant
                );

        return [
            'data' => $data,
        ];
    }

    

}