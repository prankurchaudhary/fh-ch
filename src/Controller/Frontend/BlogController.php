<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Pimcore\Model\DataObject\BlogPost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class BlogController extends AbstractController
{
    /**
     * Blog listing page
     */
    #[Route('/features', name: 'features')]
    public function listAction(Request $request, PaginatorInterface $paginator): Response
    {
        $page  = max(1, (int) $request->query->get('page', 1));
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $listing = new BlogPost\Listing();
        $listing->setCondition('published = 1');
        $listing->setOrderKey('publishedDate');
        $listing->setOrder('DESC');
        $listing->setLimit($limit);
        $listing->setOffset($offset);

        $pagination = $paginator->paginate(
            $listing,
            $request->query->getInt('page', 1),
            20
        );

        $totalCount = $listing->count();
        $totalPages = (int) ceil($totalCount / $limit);

        return $this->render('frontend/blog/list.html.twig', [
            'blogs'       => $pagination,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
        ]);
    }

    /**
     * Blog detail page
     */
    #[Route('/feature/{blogType}/{slug}', name: 'blog_detail')]
    public function detailAction(string $slug): Response
    {
        $blog = BlogPost::getBySlug($slug, 1);

        if (!$blog || !$blog->isPublished()) {
            throw $this->createNotFoundException('Blog not found');
        }

        // Blogs by same author (Expert)
        $authorBlogs = null;
        if ($blog->getAuthor()) {
            $authorBlogs = new BlogPost\Listing();
            $authorBlogs->setCondition(
                'author__id = ? AND o_id != ?',
                [$blog->getAuthor()->getId(), $blog->getId()]
            );
            $authorBlogs->setLimit(5);
        }

        // Blogs featuring same restaurants
        $relatedBlogs = new BlogPost\Listing();
        if (count($blog->getFeaturedRestaurants() ?? []) > 0) {
            $ids = array_map(
                fn($r) => $r->getId(),
                $blog->getFeaturedRestaurants()
            );

            $relatedBlogs->setCondition(
                'featuredRestaurants__id IN (' . implode(',', $ids) . ') AND o_id != ?',
                [$blog->getId()]
            );
            $relatedBlogs->setLimit(5);
        }

        return $this->render('frontend/blog/detail.html.twig', [
            'blog' => $blog,
            'authorBlogs' => $authorBlogs,
            'relatedBlogs' => $relatedBlogs
        ]);
    }
}
