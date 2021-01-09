<?php

namespace App\Controller\Admin;

use App\Repository\ProdottoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/admin/product/show", name="admin_product")
     */
    public function index(ProdottoRepository $prodottoRepository): Response
    {
        return $this->render('admin/product/product.html.twig', [
            'products' => $prodottoRepository->findAll()
        ]);
    }
}
