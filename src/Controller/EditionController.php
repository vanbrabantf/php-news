<?php

namespace App\Controller;

use App\Repository\EditionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditionController extends Controller
{
    public function show(int $editionId)
    {
        $repository = $this->get(EditionRepository::class);

        $edition = $repository->findWithPosts($editionId);

        return $this->render('edition/show.html.twig', [
            'edition' => $edition,
        ]);
    }
}
