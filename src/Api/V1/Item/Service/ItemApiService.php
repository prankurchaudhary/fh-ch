<?php

namespace App\Api\V1\Item\Service;

use App\Api\V1\Common\DTO\CollectionResponse;
use App\Api\V1\Common\DTO\PaginationResponse;
use App\Api\V1\Common\Request\PaginationRequest;
use App\Api\V1\Item\Mapper\ItemMapper;
use Pimcore\Model\DataObject\Item;

use App\Api\V1\RestaurantLike\Service\RestaurantLikeStatusService;
use App\Security\WebsiteUserAdapter;
use Symfony\Bundle\SecurityBundle\Security;

final class ItemApiService
{
    public function __construct(
    private readonly ItemMapper $itemMapper,
    private readonly RestaurantLikeStatusService $restaurantLikeStatusService,
    private readonly Security $security,
    ) {
    }

    /**
     * Return all items with pagination.
     */
    public function list(
        PaginationRequest $pagination
    ): CollectionResponse {
        $likedRestaurantIds = $this->getLikedRestaurantIds();
        $listing = new Item\Listing();

        $listing->setOrderKey('itemName');
        $listing->setOrder('ASC');

        $total = $listing->getTotalCount();

        $listing->setOffset($pagination->getOffset());
        $listing->setLimit($pagination->limit);

        $data = [];

       // $items = [];
    //  dd($likedRestaurantIds );

        foreach ($listing as $item) {
            $restaurant = $item->getRestaurant();          

            $liked = $restaurant !== null
                && isset($likedRestaurantIds[$restaurant->getId()]);
            //dd($liked);

            $data[] = $this->itemMapper->map(
                $item,
                $likedRestaurantIds
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
     * Return items belonging to a specific city with pagination.
     */
    public function listByCity(
        int $cityId,
        int $page = 1,
        int $limit = 20
    ): array {
        $likedRestaurantIds = $this->getLikedRestaurantIds();
        $listing = new Item\Listing();

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

        $items = [];

        foreach ($listing as $item) {
            //dd($item->getId());
            $restaurant = $item->getRestaurant();

            $liked = $restaurant !== null
                && isset($likedRestaurantIds[$restaurant->getId()]);

            $data[] = $this->itemMapper->map(
                    $item,
                    $likedRestaurantIds
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
     * Return items belonging to a specific category with pagination.
     */
    public function listByCategory(
        int $categoryId,
        int $page = 1,
        int $limit = 20
    ): array {
        $likedRestaurantIds = $this->getLikedRestaurantIds();
        $listing = new Item\Listing();

        $listing->setCondition(
            'category__id = ?',
            [$categoryId]
        );

        $total = $listing->getTotalCount();

        $offset = ($page - 1) * $limit;

        $listing->setOffset($offset);
        $listing->setLimit($limit);
        $listing->setOrderKey('id');
        $listing->setOrder('ASC');

        $items = [];

        foreach ($listing as $item) {
            $restaurant = $item->getRestaurant();

            $liked = $restaurant !== null
                && isset($likedRestaurantIds[$restaurant->getId()]);

            $data[] = $this->itemMapper->map(
                $item,
                $liked
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


    // private function mapListing(
    //     Item\Listing $listing,
    //     int $page,
    //     int $limit
    // ): array {
    //     $total = $listing->getTotalCount();

    //     $listing->setOffset(($page - 1) * $limit);
    //     $listing->setLimit($limit);
    //     $listing->setOrderKey('id');
    //     $listing->setOrder('ASC');

    //     $items = [];

    //     foreach ($listing as $item) {
    //         $items[] = $this->itemMapper->map($item);
    //     }

    //     return [
    //         'data' => $items,
    //         'pagination' => [
    //             'page' => $page,
    //             'limit' => $limit,
    //             'total' => $total,
    //             'pages' => $limit > 0 ? (int) ceil($total / $limit) : 0,
    //         ],
    //     ];
    // }

    

    

    private function getLikedRestaurantIds(): array
    {
        $authenticatedUser = $this->security->getUser();

        if (!$authenticatedUser instanceof WebsiteUserAdapter) {
            return [];
        }

        return $this->restaurantLikeStatusService
            ->getLikedRestaurantIds(
                $authenticatedUser->getUserObject()
            );
    }
}