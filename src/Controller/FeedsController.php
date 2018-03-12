<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\RssGeneratorService;
use Symfony\Component\HttpFoundation\Response;

class FeedsController
{
    /**
     * @var RssGeneratorService
     */
    private $generator;

    /**
     * FeedsController constructor.
     * @param RssGeneratorService $generator
     */
    public function __construct(RssGeneratorService $generator)
    {
        $this->generator = $generator;
    }

    public function rss2()
    {
        return new Response($this->generator->generate(), 200, [
            'Content-Type' => 'application/rss+xml'
        ]);
    }
}
