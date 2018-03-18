<?php

namespace App\Controller;

use App\Document\Post;
use App\Service\LatestPostsService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LatestPostsController extends Controller
{
    /**
     * @var LatestPostsService
     */
    private $latestPosts;

    /**
     * LatestPostsController constructor.
     * @param LatestPostsService $latestPosts
     */
    public function __construct(LatestPostsService $latestPosts)
    {
        $this->latestPosts = $latestPosts;
    }

    public function index()
    {
        $posts = $this->latestPosts->get();

        return $this->render('post/latest.html.twig', array('posts' => $posts));
    }
}
