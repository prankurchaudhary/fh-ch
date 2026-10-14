<?php

namespace App\Api\V1\RestaurantLike\Service;

use App\Api\V1\Common\DTO\CollectionResponse;
use App\Api\V1\Common\DTO\PaginationResponse;
use App\Api\V1\Common\Request\PaginationRequest;
use App\Api\V1\RestaurantLike\Mapper\RestaurantLikeMapper;
use Pimcore\Model\DataObject\RestaurantLike;
use Pimcore\Model\DataObject\WebsiteUser;

use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\DataObject\Restaurant;

final class RestaurantLikeApiService
{
    public function __construct(
        private readonly RestaurantLikeMapper $restaurantLikeMapper,
    ) {
    }

    public function getLikedRestaurants(
        WebsiteUser $user,
        PaginationRequest $pagination
    ): CollectionResponse {
        $listing = new RestaurantLike\Listing();

        $listing->setCondition(
            'user__id = ?',
            [$user->getId()]
        );

        $listing->setOrderKey('createdAt');
        $listing->setOrder('DESC');

        $total = $listing->getTotalCount();

        $listing->setOffset($pagination->getOffset());
        $listing->setLimit($pagination->limit);

        $data = [];

        foreach ($listing as $restaurantLike) {
            $data[] = $this->restaurantLikeMapper->map($restaurantLike);
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


    public function likeRestaurant(
            WebsiteUser $user,
            int $restaurantId
        ): RestaurantLike {
            $restaurant = Restaurant::getById($restaurantId);

            if (!$restaurant instanceof Restaurant) {
                throw new \InvalidArgumentException('Restaurant not found');
            }

            // Check whether the user has already liked this restaurant
            $listing = new RestaurantLike\Listing();

            $listing->setCondition(
                'user__id = ? AND restaurant__id = ?',
                [
                    $user->getId(),
                    $restaurant->getId(),
                ]
            );

            if ($listing->count() > 0) {
                throw new \LogicException('Restaurant already liked');
            }

            $parent = Folder::getByPath('/RestaurantLikes');

            if (!$parent) {
                throw new \RuntimeException('Likes folder missing');
            }

            $like = new RestaurantLike();

            $like->setParent($parent);

            $like->setKey(sprintf(
                'like-%d-%d',
                $user->getId(),
                $restaurant->getId()
            ));

            $like->setPublished(true);
            $like->setUser($user);
            $like->setRestaurant($restaurant);
            $like->setCreatedAt(\Carbon\Carbon::now());

            $like->save();

            return $like;
        }

        public function unlikeRestaurant(
            WebsiteUser $user,
            int $restaurantId
        ): void {
            $restaurant = Restaurant::getById($restaurantId);

            if (!$restaurant instanceof Restaurant) {
                throw new \InvalidArgumentException('Restaurant not found');
            }

            $listing = new RestaurantLike\Listing();

            $listing->setCondition(
                'user__id = ? AND restaurant__id = ?',
                [
                    $user->getId(),
                    $restaurant->getId(),
                ]
            );

            if ($listing->count() === 0) {
                throw new \LogicException('Restaurant is not liked');
            }

            foreach ($listing as $like) {
                $like->delete();
            }
        }
}