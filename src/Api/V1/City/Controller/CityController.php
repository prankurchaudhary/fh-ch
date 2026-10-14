<?php

namespace App\Api\V1\City\Controller;

use App\Api\V1\Common\Request\PaginationRequest;
use App\Api\V1\City\DTO\CityResponse;
use App\Api\V1\City\Service\CityApiService;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;
use App\Api\V1\Common\DTO\PaginationResponse;

#[AsController]
#[Route('/api/v1/cities')]
#[OA\Tag(
    name: 'Cities',
    description: 'City APIs'
)]
final class CityController
{
    public function __construct(
        private readonly CityApiService $cityApiService
    ) {
    }

    #[Route('', name: 'api_v1_cities_list', methods: ['GET'])]
    #[OA\Get(
        summary: 'Get cities',
        description: 'Returns a paginated list of Chowzter cities'
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
        description: 'List of cities',
        content: new OA\JsonContent(
        properties: [
            new OA\Property(
                property: 'data',
                type: 'array',
                items: new OA\Items(
                    ref: new Model(type: CityResponse::class)
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

        $response = $this->cityApiService->getCities($pagination);

        return new JsonResponse(
            $response->toArray()
        );
    }
}