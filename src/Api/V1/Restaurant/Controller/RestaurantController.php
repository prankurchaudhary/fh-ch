<?php

namespace App\Api\V1\Restaurant\Controller;

use App\Api\V1\Restaurant\Service\RestaurantApiService;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use App\Api\V1\Restaurant\DTO\RestaurantResponse;
use App\Api\V1\Common\DTO\PaginationResponse;
use App\Api\V1\Common\Request\PaginationRequest;

#[Route('/api/v1')]
#[OA\Tag(
    name: 'Restaurants',
    description: 'Restaurant APIs'
)]
final class RestaurantController extends AbstractController
{
    public function __construct(
        private readonly RestaurantApiService $restaurantApiService,
    ) {
    }

    #[Route(
        '/restaurants',
        name: 'api_v1_restaurants_list',
        methods: ['GET']
    )]
    #[OA\Get(
        summary: 'Get Restaurants',
        description: 'Returns a paginated list of Chowzter restaurants'
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
        description: 'List of restaurants',
        content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(
                    ref: new Model(type: RestaurantResponse::class)
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
    public function list(Request $request): JsonResponse
    {
        $pagination = PaginationRequest::fromRequest($request);

        $response = $this->restaurantApiService->list($pagination);

        return new JsonResponse(
            $response->toArray()
        );
    }

    #[Route(
        '/cities/{cityId}/restaurants',
        name: 'api_v1_city_restaurants_list',
        requirements: [
            'cityId' => '\d+'
        ],
        methods: ['GET']
    )]
    #[OA\Get(
        summary: 'Get restaurants by city',
        description: 'Returns a paginated list of restaurants belonging to a specific city.',
        parameters: [
            new OA\Parameter(
                name: 'cityId',
                description: 'City ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 123
                )
            ),
            new OA\Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    minimum: 1,
                    default: 1
                )
            ),
            new OA\Parameter(
                name: 'limit',
                description: 'Number of restaurants per page',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    minimum: 1,
                    maximum: 100,
                    default: 20
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'City restaurants retrieved successfully'
            )
        ]
    )]
    public function listByCity(
        int $cityId,
        Request $request
    ): JsonResponse {
        $page = max(
            1,
            $request->query->getInt('page', 1)
        );

        $limit = min(
            100,
            max(
                1,
                $request->query->getInt('limit', 20)
            )
        );

        return $this->json(
            $this->restaurantApiService->listByCity(
                $cityId,
                $page,
                $limit
            )
        );
    }


    #[Route(
        '/restaurants/{Id}',
        name: 'api_v1_restaurants_by_id',
        requirements: [
            'Id' => '\d+'
        ],
        methods: ['GET']
    )]
    #[OA\Get(
        summary: 'Get restaurants by Id',
        description: 'Returns a Restaurant by Id.',
        parameters: [
            new OA\Parameter(
                name: 'Id',
                description: 'Restaurant ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 123
                )
            ),
            new OA\Parameter(
                name: 'page',
                description: 'Page number',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    minimum: 1,
                    default: 1
                )
            ),
            new OA\Parameter(
                name: 'limit',
                description: 'Number of restaurants per page',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    minimum: 1,
                    maximum: 100,
                    default: 20
                )
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Restaurant retrieved successfully'
            )
        ]
    )]
    public function getById(
        int $Id,
        Request $request
    ): JsonResponse {
        $page = max(
            1,
            $request->query->getInt('page', 1)
        );

        $limit = min(
            100,
            max(
                1,
                $request->query->getInt('limit', 20)
            )
        );

        return $this->json(
            $this->restaurantApiService->getById(
                $Id,
                $page,
                $limit
            )
        );
    }


   



}