<?php

namespace App\Controller\Frontend;

use Pimcore\Model\DataObject\Folder;
use Pimcore\Model\DataObject\WebsiteUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\City\Listing as CityListing;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\WebsiteUser\Listing;
use Pimcore\Db;

class HomeController extends AbstractController {

    #[Route('/', name: 'frontend_home')]
     public function home(Request $request)
    {
        $db = Db::get();

        $ids = $db->fetchFirstColumn("
            SELECT o.id
            FROM object_City o
            WHERE o.published = 1 AND cityPhoto IS NOT NULL AND active = 1
            ORDER BY RAND()
            LIMIT 30
        ");

        $cities = [];

        if (!empty($ids)) {
            $listing = new City\Listing();
            $listing->setCondition('id IN (' . implode(',', array_map('intval', $ids)) . ')');
            $cities = $listing->load();
        }

        $experts = new WebsiteUser\Listing();
        $experts->setCondition(
            'isActive = 1 AND avatar IS NOT NULL'
        );
        $experts->setOrderKey('firstname');
        $experts->setOrder('ASC');
        
        return $this->render('frontend/home.html.twig', ['cities' => $cities, 'experts' => $experts]);
    
    }
}
