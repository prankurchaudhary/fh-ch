<?php

namespace App\Controller\Frontend;

use Pimcore\Model\DataObject\WebsiteUser;
use Pimcore\Model\DataObject\WebsiteUser\Listing;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Model\DataObject\City;
use App\Service\CacheTagService;



class ExpertController extends AbstractController
{
    #[Route('/experts', name: 'expert_list')]
    public function list(CacheTagService $cacheTagService): Response
    {
        $cities = new City\Listing();
        $cities->setCondition('published = 1');
        $cities->addConditionParam('expert__id IS NOT NULL');
        $cities->setOrderKey('name');
        $cities->setOrder('ASC');
        $response = $this->render('frontend/expert/list.html.twig', [
            'cities' => $cities
        ]);
        $tags = [
            'experts_list'
        ];

        $cacheTagService->addTags($response, $tags);
        $response->setPublic();
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);
        return $response;
    }

    #[Route('/experts/{handle}', name: 'expert_detail')]
    public function detail(string $handle, CacheTagService $cacheTagService): Response
    {
        $expert = WebsiteUser::getByHandle($handle, 1);

        if (!$expert || !$expert->getIsExpert()) {
            throw $this->createNotFoundException();
        }
        $tags = [
            'experts_list', 'expert_' . $expert->getId()
        ];

        
        $response = $this->render('frontend/expert/detail.html.twig', [
            'expert' => $expert
        ]);
        $cacheTagService->addTags($response, $tags);
        $response->setPublic();
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);

        return $response;
    }
}
