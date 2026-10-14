<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Cache;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'global_search')]
    public function search(Request $request, UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        $query = trim($request->get('q'));

        if (!$query || strlen($query) < 2) {
            return new JsonResponse([]);
        }

        // 🔥 Cache key
        $cacheKey = 'search_' . md5($query);

        // Try cache first
        $cache = \Pimcore\Cache::load($cacheKey);
        if ($cache) {
            return new JsonResponse(json_decode($cache, true));
        }

        $results = [
            'cities' => [],
            'restaurants' => [],
            'experts' => [],
        ];

        // 🔍 Cities
        $cities = new \Pimcore\Model\DataObject\City\Listing();
        $cities->setCondition('name LIKE ?', ['%' . $query . '%']);
        $cities->setLimit(5);

        foreach ($cities as $city) {
             $results['cities'][] = [
                'name' => $city->getName(),
                'url' => $urlGenerator->generate(
                    'city_page',
                    [   'continentSlug' => $city->getContinent()->getSlug(),
                        'citySlug' => $city->getSlug()
                    ]
                )
            ];
        }

        // 🍽 Items
        $items = new \Pimcore\Model\DataObject\Item\Listing();
        $items->setCondition('itemName LIKE ?', ['%' . $query . '%']);
        $items->setLimit(5);

        foreach ($items as $i) {

            $results['restaurants'][] = [
                'name' => $i->getItemName(),
                'restaurant_name' => $i->getRestaurant()->getName(),
                'url' => $urlGenerator->generate(
                    'restaurant_detail',
                    [   'continentSlug' => $i->getCity()->getContinent()->getSlug(),
                        'citySlug' => $i->getCity()->getSlug(),
                        'restaurantSlug' => $i->getRestaurant()->getSlug(),
                        'dish_slug' => $i->getSlug()
                    ]
                )
            ];
            // $results['restaurants'][] = [
            //     'name' => $r->getName(),
            //     'url' => '/restaurant/' . $r->getSlug()
            // ];
        }

        // 👨‍🍳 Experts
        $experts = new \Pimcore\Model\DataObject\WebsiteUser\Listing();
        $experts->setCondition('handle LIKE ? AND isExpert = 1', ['%' . $query . '%']);
        $experts->setLimit(5);

        foreach ($experts as $e) {
            $results['experts'][] = [
                'name' => $e->getHandle(),
                'url' => '/experts/' . $e->getHandle()
            ];
        }

        // 🍔 Categories
        $categories = new \Pimcore\Model\DataObject\FoodCategory\Listing();

        $categories->setCondition(
            'categoryName LIKE ?',
            ['%' . $query . '%']
        );

        $categories->setLimit(5);

        foreach ($categories as $category) {

            $results['categories'][] = [
                'name' => $category->getCategoryName(),
                'url' => $urlGenerator->generate(
                    'category_restaurants',
                    [
                        'slug' => $category->getSlug()
                    ]
                )
            ];
        }


        $cache = Cache::load($cacheKey);

        Cache::save(
            json_encode($results),
            $cacheKey,
            ['search'],
            300
        );

        return new JsonResponse($results);
    }
}

