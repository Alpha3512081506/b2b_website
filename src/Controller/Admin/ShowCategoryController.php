<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowCategoryController extends AbstractController
{
    /**
     * @Route("/admin/show/category", name="admin_show_category")
     */
    public function index(): Response
    {
        return $this->render('admin/category/category.html.twig', []);
    }
}
