<?php

namespace App\Controller;

use App\Repository\ProdottoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(ProdottoRepository $prodottoRepository): Response
    {
        $product = $prodottoRepository->findBy([], [], 6);
        return $this->render('product/home.html.twig', [
            'products' => $product,
        ]);
    }
}
