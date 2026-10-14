<?php

namespace App\Api\V1\Item\Controller;

use App\Api\V1\Item\Service\ItemApiService;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use App\Api\V1\Item\DTO\ItemResponse;
use App\Api\V1\Common\DTO\PaginationResponse;
use App\Api\V1\Common\Request\PaginationRequest;

#[Route('/api/v1')]
#[OA\Tag(
    name: 'Items',
    description: 'Item APIs'
)]
final class ItemController extends AbstractController
{
    public function __construct(
        private readonly ItemApiService $itemApiService,
    ) {
    }

    #[Route(
        '/items',
        name: 'api_v1_items_list',
        methods: ['GET']
    )]
    #[OA\Get(
        summary: 'Get Items',
        description: 'Returns a paginated list of Chowzter Itens'
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
        description: 'List of Itens',
        content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(
                    ref: new Model(type: ItemResponse::class)
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

        $response = $this->itemApiService->list($pagination);

        return new JsonResponse(
            $response->toArray()
        );
    }

    #[Route(
        '/cities/{cityId}/items',
        name: 'api_v1_city_items_list',
        requirements: [
            'cityId' => '\d+'
        ],
        methods: ['GET']
    )]
    #[OA\Get(
        summary: 'Get items by city',
        description: 'Returns a paginated list of items belonging to a specific city.',
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
                description: 'Number of items per page',
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
                description: 'City items retrieved successfully'
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
            $this->itemApiService->listByCity(
                $cityId,
                $page,
                $limit
            )
        );
    }

    #[Route(
        '/categories/{categoryId}/items',
        name: 'api_v1_category_items_list',
        requirements: [
            'categoryId' => '\d+'
        ],
        methods: ['GET']
    )]
    #[OA\Get(
        summary: 'Get items by Category',
        description: 'Returns a paginated list of items belonging to a specific Category.',
        parameters: [
            new OA\Parameter(
                name: 'categoryId',
                description: 'cayegory ID',
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
                description: 'Number of items per page',
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
                description: 'Category items retrieved successfully'
            )
        ]
    )]
    public function listByCategory(
        int $categoryId,
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
            $this->itemApiService->listByCategory(
                $categoryId,
                $page,
                $limit
            )
        );
    }




}