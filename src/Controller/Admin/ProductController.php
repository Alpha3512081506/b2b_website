<?php

namespace App\Controller\Admin;

use App\Entity\Prodotto;
use App\Repository\ProdottoRepository;
use App\Service\PaginationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/admin/product/show/{page<\d+>?1}", name="admin_product")
     */
    public function index(ProdottoRepository $prodottoRepository, $page, PaginationService $paginationService): Response
    {
        $paginationService->setEntityClass(Prodotto::class)->setCurrentPage($page);
        $paginationService->getData();




        //$products = $prodottoRepository->findBy([], ['created_At' => 'DESC'], $limit, $start);

        return $this->render('admin/product/product.html.twig', [
            'products' =>  $paginationService->getData(),
            'pages' =>  $paginationService->getPages(),
            'page' => $page,


        ]);
    }
}
