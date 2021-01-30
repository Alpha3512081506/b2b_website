<?php

namespace App\Controller\Admin;

use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
use App\Service\PaginationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category/show/{page<\d+>?1}", name="admin_show_category")
     */
    public function index($page, PaginationService $paginationService): Response
    {
        $paginationService = $paginationService->setEntityClass(Categoria::class)->setPage($page);


        return $this->render('admin/category/category.html.twig', [
            'categoriesCtrl' => $paginationService->getData(),
            'paginationService' => $paginationService,

        ]);
    }

    /**
     * @Route("/admin/category/{id<\d+>}/delete", name="admin_category_delete")
     */
    public function delete($id, Categoria $category, EntityManagerInterface $entityManagerInterface): Response
    {


        if ($category->getProdotti()->count() > 0) {
            $this->addFlash(
                "warning",
                "Non è possible di cancellare una categoria che contiene dei prodotti"
            );
        } else {
            $entityManagerInterface->remove($category);
            $entityManagerInterface->flush();
            $this->addFlash(
                "success",
                "La Categoria  {$category->getNomeCategoria()} è stata Cancellata"
            );
        }




        return $this->redirectToRoute("admin_show_category");
    }
}
