<?php

// src/Controller/Frontend/CityController.php

namespace App\Controller\Frontend;

// use Pimcore\Controller\FrontendController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\FoodCategory;
use Pimcore\Model\DataObject\Restaurant;
use Pimcore\Model\DataObject\Item;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Model\DataObject\City\Listing as CityListing;
use Symfony\Component\Intl\Countries;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Carbon\Carbon;
use Pimcore\Model\DataObject\WebsiteUser;
use Pimcore\Model\DataObject\RestaurantLike;
use Pimcore\Model\DataObject\RestaurantLike\Listing;
use App\Security\WebsiteUserAdapter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pimcore\Model\DataObject\Folder;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\Service\RestaurantOpenStatusService;
use App\Service\CacheTagService;
use Knp\Component\Pager\PaginatorInterface;
use App\Service\WishlistService;

class CityController  extends AbstractController
{   
    use TargetPathTrait;
    #[Route('/city/{continentSlug}/{citySlug}', name: 'city_page', priority: -10, 
    requirements: [
        'continentSlug' => '(?!reset-password|login|register|logout)[a-z0-9\-]+',
        'citySlug' => '[a-z0-9\-]+'
    ])]
    public function cityPage(string $citySlug, Request $request, CacheTagService $cacheTagService, PaginatorInterface $paginator)
    {
        $websiteUser = $this->getUser(); // Symfony user (adapter)
        $categorySlug = $request->query->get('category');
        $category = null;
        $selectedCategory = '';
        if ($categorySlug) {
            $category = FoodCategory::getBySlug($categorySlug, 1);
        }
        $city = City::getBySlug($citySlug, 1);
        if (!$city) {
            throw new NotFoundHttpException('City not found');
        }
        
        $listing = new Item\Listing();
        $conditions = ['city__id = ?'];
        $params     = [$city->getId()];

        if ($category) {
            $selectedCategory = $category->getSlug();
            $conditions[] = 'category__id = ?';
            $params[]     = $category->getId();
        }

        $listing->setCondition(
            implode(' AND ', $conditions),
            $params
        );

        //  $listing->setCondition(
        //     'city__id = ?',
        //     $params
        // );
        $items = $listing->load();

        // KNP CODE
        $pagination = $paginator->paginate(
            $items,
            $request->query->getInt('page', 1),
            20
        );


        $allItems = new Item\Listing();
        $allItems->setCondition(
            'city__id = ?',
            [$city->getId()]
        );
        $categoryMap = [];
        foreach ($allItems as $item) {
            $category = $item->getCategory();
            if ($category instanceof FoodCategory) {
                $categoryMap[$category->getId()] = $category;
            }
         }
        $categories = array_values($categoryMap);
        
        // Fetch experts for the city

        $experts = new WebsiteUser\Listing();
        $experts->setCondition('city__id = ?', [$city->getId()]);

        $likedIds = [];$wishlistIds = [];
        if($websiteUser  instanceof WebsiteUserAdapter) {
            
            $userId = $websiteUser->getUserObject()->getId();
            $likedListing = new \Pimcore\Model\DataObject\RestaurantLike\Listing();
            $likedListing->setCondition('user__id = ?', [$userId]);

            $wishlistListing = new \Pimcore\Model\DataObject\RestaurantWishlist\Listing();
            $wishlistListing->setCondition('user__id = ?', [$userId]);

            $likedIds = []; $wishlistIds = [];
            foreach ($likedListing as $like) {
                $likedIds[] = $like->getRestaurant()->getId();
            }

            foreach($wishlistListing as $wl) {
                $wishlistIds[] = $wl->getRestaurant()->getId();
            }
        }

        $response = $this->render('frontend/city/listing.html.twig', [
            'city' => $city,
            'items' => $pagination,
            'total' => $listing->getTotalCount(),
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'experts' => $experts,
            'likedIds' => $likedIds,
            'wishlistIds' => $wishlistIds
        ]);
        if ($city && $city->getId()) {
            $tags[] = 'city_' . $city->getId();
            $cacheTagService->addTags($response, $tags);

            $response->setPublic();
            $response->setMaxAge(3600);
            $response->setSharedMaxAge(3600);
        }

        return $response;
    }

    #[Route('/{continentSlug}/{citySlug}/review/{restaurantSlug}/{dish_slug}', name: 'restaurant_detail')]
    public function restaurantDetail(string $citySlug, string $restaurantSlug, string $dish_slug, RestaurantOpenStatusService $availabilityService, CacheTagService $cacheTagService)
    {
       
        $now = Carbon::now();
        $todayKey = strtolower($now->format('l'));
        $todaySchedule = null;
        $isOpen = false;
        $city = City::getBySlug($citySlug, 1);
        if (!$city) {
            throw $this->createNotFoundException();
        }

        $restaurant = Restaurant::getBySlug($restaurantSlug, 1);

        if (!$restaurant) {
            throw $this->createNotFoundException();
        }

        $list = new Item\Listing();
        $list->setCondition(
            'slug = ? AND restaurant__id = ?',
            [$dish_slug, $restaurant->getId()]
        );
        $list->setLimit(1);

        $item = $list->current();

        $availability = $availabilityService->getStatus($restaurant);
        
        foreach ($restaurant->getOpeningHours() ?? [] as $row) {
            if ((strtolower($row['day']->getData()) ?? null) === $todayKey) {
                $todaySchedule = $row;
                if (!($row['isClosed']->getData() ?? false)) {
                    $open = Carbon::createFromFormat(
                        'H:i',
                        $row['openTime']->getData()
                    );

                    $close = Carbon::createFromFormat(
                        'H:i',
                        $row['closeTime']->getData()
                    );

                    $isOpen = $now->between($open, $close);
                }

                break;
            }
        }

        $response = $this->render('frontend/restaurant/detail.html.twig', [
            'restaurant' => $restaurant,
            'city' => $city,
            'item' => $item,
            'todaySchedule' => $todaySchedule,
            'isOpen' => $isOpen,
            'availability' => $availability
        ]);
        $tags = [
            'restaurant_' . $restaurant->getId()
        ];
        if ($restaurant->getCity()) {
            $tags[] = 'city_' . $restaurant->getCity()->getId();
        }
        $cacheTagService->addTags($response, $tags);

        $response->setPublic();
        $response->setMaxAge(3600);
        $response->setSharedMaxAge(3600);

        return $response;
    }
    #[Route('/browse-cities', name: 'browse_cities')]
    public function locationMenuAction(CacheTagService $cacheTagService)
    {
        $list = new CityListing();
        $list->setOrderKey('name');
        $list->setOrder('ASC');

        $tree = [];

        foreach ($list as $city) {
            $continent = $city->getContinent();
            $continentName = $continent->getName();
            $country   = $city->getCountry();
            $countryName = Countries::getName($country);

            if (!isset($tree[$continentName])) {
                $tree[$continentName] = [];
            }
            if (!isset($tree[$continentName][$countryName])) {
                $tree[$continentName][$countryName] = [];
            }

            // Add city
            $tree[$continentName][$countryName][] = $city;
        }

        

        $response =  $this->render('frontend/city/browse_cities.html.twig', [
            'tree' => $tree
        ]);
        if (!empty($tree)) {
            $tags[] = 'browse_cities';
            $cacheTagService->addTags($response, $tags);

            $response->setPublic();
            $response->setMaxAge(3600);
            $response->setSharedMaxAge(3600);
        }

        return $response;
    }
    
    #[Route('/restaurant/{id}/like', name: 'restaurant_like', methods: ['POST'])]    
    public function toggleLike(Request $request, int $id): JsonResponse

    {
       if (!$this->getUser()) {
            return new JsonResponse(['loginRequired' => true], 401);
       }
        

    $restaurant = Restaurant::getById($id);

    if (!$restaurant instanceof Restaurant) {
        return new JsonResponse(['error' => 'Restaurant not found'], 404);
    }

    try {
        $user = $this->getUser()->getUserObject();
        $userId = $user->getId();

        $listing = new Listing();
        $listing->setCondition(
            'user__id = ? AND restaurant__id = ?',
            [$userId, 
            $restaurant->getId()]
        );

        // UNLIKE
        if ($listing->count() > 0) {
            foreach ($listing as $like) {
                $like->delete();
            }

            return new JsonResponse(['liked' => false]);
        }

        // LIKE
        $like = new RestaurantLike();
        $parent = Folder::getByPath('/RestaurantLikes');
        if (!$parent) {
            return new JsonResponse(['error' => 'Likes folder missing'], 500);
        }

        $like->setParent($parent);

        // ✅ UNIQUE, VALID KEY
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

        return new JsonResponse(['liked' => true]);

    } catch (\Exception $e) {
        return new JsonResponse(
            ['error' => $e->getMessage()],
            500
        );
    }
    }


    #[Route('/food-category/{slug}', name: 'category_restaurants')]
    public function categoryRestaurants( string $slug,
                                        Request $request,
                                        PaginatorInterface $paginator)
    {
        $category = \Pimcore\Model\DataObject\FoodCategory::getBySlug($slug, 1);
       
        if (!$category) {
            throw $this->createNotFoundException();
        }
      
        $items = new \Pimcore\Model\DataObject\Item\Listing();

        $items->setCondition(
            'category__id = ?',
            [$category->getId()]
        );

        $items->setOrderKey('itemName');
        $items->setOrder('ASC');

        $pagination = $paginator->paginate(
            $items,
            $request->query->getInt('page', 1),
            20
        );
        $totalItems = $items->getTotalCount();

        
        return $this->render(
            'frontend/category/restaurants.html.twig',
            [
                'category' => $category,
                'items' => $pagination,
                'totalItems' => $totalItems
            ]
        );
    }

    #[Route('/restaurant/{id}/wishlist', name: 'restaurant_wishlist', methods: ['POST'])]
    public function toggleWishlist(
        Request $request, int $id,
        WishlistService $wishlistService
    ): JsonResponse {

        if (!$this->getUser()) {
            return new JsonResponse(['loginRequired' => true], 401);
       }

        $restaurant = Restaurant::getById($id);
        $user = $this->getUser()->getUserObject();
        if (!$restaurant instanceof Restaurant) {
            return new JsonResponse(['error' => 'Restaurant not found'], 404);
        }

        if ($wishlistService->isWishlisted($user, $restaurant)) {

            $wishlistService->removeFromWishlist($user, $restaurant);

            return  new JsonResponse([
                'success' => true,
                'wishlisted' => false
            ]);
        }

        $wishlistService->addToWishlist($user, $restaurant);

        return  new JsonResponse([
            'success' => true,
            'wishlisted' => true
        ]);
    }

    #[Route('/tag/{slug}', name: 'tag_restaurants')]
    public function tagRestaurants( string $slug,
                                        Request $request,
                                        PaginatorInterface $paginator)
    {
        $tag = \Pimcore\Model\DataObject\Tag::getBySlug($slug, 1);
       
        if (!$tag) {
            throw $this->createNotFoundException();
        }
      
        $items = $tag->getItems();

        $pagination = $paginator->paginate(
            $items,
            $request->query->getInt('page', 1),
            20
        );

        $totalItems = count($items);

        
        return $this->render(
            'frontend/tag/restaurants.html.twig',
            [
                'tag' => $tag,
                'items' => $pagination,
                'totalItems' => $totalItems
            ]
        );
    }


}
