<?php

namespace App\Api\V1\RestaurantLike\Controller;

use App\Api\V1\Common\DTO\PaginationResponse;
use App\Api\V1\Common\Request\PaginationRequest;
use App\Api\V1\RestaurantLike\DTO\RestaurantLikeResponse;
use App\Api\V1\RestaurantLike\Service\RestaurantLikeApiService;
use App\Security\WebsiteUserAdapter;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;


#[AsController]
#[Route('/api/v1/me')]
#[OA\Tag(
    name: 'Restaurant Likes',
    description: 'Restaurant like APIs'
)]
final class RestaurantLikeController
{
    public function __construct(
        private readonly RestaurantLikeApiService $restaurantLikeApiService,
        private readonly Security $security,
    ) {
    }

    #[Route(
        '/liked-restaurants',
        name: 'api_v1_my_liked_restaurants',
        methods: ['GET']
    )]
    #[OA\Get(
        summary: 'Get liked restaurants',
        description: 'Returns restaurants liked by the authenticated user'
    )]
    #[OA\Parameter(
        name: 'page',
        description: 'Page number',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'integer',
            minimum: 1,
            default: 1
        )
    )]
    #[OA\Parameter(
        name: 'limit',
        description: 'Number of records per page. Maximum 100.',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'integer',
            minimum: 1,
            maximum: 100,
            default: 20
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Liked restaurants',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(
                        ref: new Model(type: RestaurantLikeResponse::class)
                    )
                ),
                new OA\Property(
                    property: 'pagination',
                    ref: new Model(type: PaginationResponse::class)
                ),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 401,
        description: 'Authentication required'
    )]
    public function list(Request $request): JsonResponse
    {
        $authenticatedUser = $this->security->getUser();

        if (!$authenticatedUser instanceof WebsiteUserAdapter) {
            return new JsonResponse(
                ['loginRequired' => true],
                401
            );
        }

        $user = $authenticatedUser->getUserObject();

        $pagination = PaginationRequest::fromRequest($request);

        $response = $this->restaurantLikeApiService->getLikedRestaurants(
            $user,
            $pagination
        );

        return new JsonResponse(
            $response->toArray()
        );
    }

    #[Route(
    '/restaurants/{id}/like',
    name: 'api_v1_restaurant_like',
    methods: ['POST']
        )]
        #[OA\Post(
            summary: 'Like a restaurant',
            description: 'Likes a restaurant for the authenticated user'
        )]
        #[OA\Parameter(
            name: 'id',
            description: 'Restaurant ID',
            in: 'path',
            required: true,
            schema: new OA\Schema(
                type: 'integer',
                example: 25
            )
        )]
        #[OA\Response(
            response: 201,
            description: 'Restaurant liked successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'liked',
                        type: 'boolean',
                        example: true
                    ),
                    new OA\Property(
                        property: 'likeId',
                        type: 'integer',
                        example: 101
                    ),
                    new OA\Property(
                        property: 'restaurantId',
                        type: 'integer',
                        example: 25
                    ),
                ],
                type: 'object'
            )
        )]
        #[OA\Response(
            response: 401,
            description: 'Authentication required'
        )]
        #[OA\Response(
            response: 404,
            description: 'Restaurant not found'
        )]
        #[OA\Response(
            response: 409,
            description: 'Restaurant already liked'
        )]
        public function like(
            int $id
        ): JsonResponse {
            $authenticatedUser = $this->security->getUser();

            if (!$authenticatedUser instanceof WebsiteUserAdapter) {
                return new JsonResponse(
                    ['loginRequired' => true],
                    401
                );
            }

            $user = $authenticatedUser->getUserObject();

            try {
                $like = $this->restaurantLikeApiService->likeRestaurant(
                    $user,
                    $id
                );

                return new JsonResponse(
                    [
                        'liked' => true,
                        'likeId' => $like->getId(),
                        'restaurantId' => $id,
                    ],
                    201
                );

            } catch (\InvalidArgumentException $e) {
                return new JsonResponse(
                    ['error' => $e->getMessage()],
                    404
                );

            } catch (\LogicException $e) {
                return new JsonResponse(
                    ['error' => $e->getMessage()],
                    409
                );

            } catch (\Throwable $e) {
                return new JsonResponse(
                    ['error' => $e->getMessage()],
                    500
                );
            }
        }

        #[Route(
    '/restaurants/{id}/like',
            name: 'api_v1_restaurant_unlike',
            methods: ['DELETE']
        )]
        #[OA\Delete(
            summary: 'Unlike a restaurant',
            description: 'Removes the restaurant like for the authenticated user'
        )]
        #[OA\Parameter(
            name: 'id',
            description: 'Restaurant ID',
            in: 'path',
            required: true,
            schema: new OA\Schema(
                type: 'integer',
                example: 25
            )
        )]
        #[OA\Response(
            response: 200,
            description: 'Restaurant unliked successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'liked',
                        type: 'boolean',
                        example: false
                    ),
                    new OA\Property(
                        property: 'restaurantId',
                        type: 'integer',
                        example: 25
                    ),
                ],
                type: 'object'
            )
        )]
        #[OA\Response(
            response: 401,
            description: 'Authentication required'
        )]
        #[OA\Response(
            response: 404,
            description: 'Restaurant not found'
        )]
        #[OA\Response(
            response: 409,
            description: 'Restaurant is not liked'
        )]
        public function unlike(
            int $id
        ): JsonResponse {
            $authenticatedUser = $this->security->getUser();

            if (!$authenticatedUser instanceof WebsiteUserAdapter) {
                return new JsonResponse(
                    ['loginRequired' => true],
                    401
                );
            }

            $user = $authenticatedUser->getUserObject();

            try {
                $this->restaurantLikeApiService->unlikeRestaurant(
                    $user,
                    $id
                );

                return new JsonResponse([
                    'liked' => false,
                    'restaurantId' => $id,
                ]);

            } catch (\InvalidArgumentException $e) {
                return new JsonResponse(
                    ['error' => $e->getMessage()],
                    404
                );

            } catch (\LogicException $e) {
                return new JsonResponse(
                    ['error' => $e->getMessage()],
                    409
                );

            } catch (\Throwable $e) {
                return new JsonResponse(
                    ['error' => $e->getMessage()],
                    500
                );
            }
        }
}