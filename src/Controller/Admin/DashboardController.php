<?php

namespace App\Controller\Admin;

use App\Repository\CategoriaRepository;
use App\Repository\ProdottoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(CategoriaRepository $categoriaRepository, ProdottoRepository $prodottoRepository, UserRepository $userRepository): Response
    {
        return $this->render('admin/dashboard/dashboard.html.twig', [
            'categoriesCount' => count($categoriaRepository->findAll()),
            'productsCount' => count($prodottoRepository->findAll()),
            'usersCount' => count($userRepository->findAll())
        ]);
    }
}
