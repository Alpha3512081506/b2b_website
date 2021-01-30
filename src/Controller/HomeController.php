<?php

namespace App\Controller;

use App\Entity\Prodotto;
use App\Service\PaginationService;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/{page<\d+>?1}", name="home_index")
     */
    public function index($page, PaginationService $paginationService): Response
    {
        $paginationService = $paginationService->setEntityClass(Prodotto::class)->setPage($page)->setLimite(6);

        return $this->render('product/home.html.twig', [
            'products' => $paginationService->getData(['created_At' => 'DESC']),
            'paginationService' => $paginationService,
        ]);
    }
}
