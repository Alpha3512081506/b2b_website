<?php

namespace App\Controller\Admin;

use App\Entity\Prodotto;
use App\Repository\ProdottoRepository;
use App\Service\PaginationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/admin/product/show/{page<\d+>?1}", name="admin_product")
     */
    public function index($page, PaginationService $paginationService): Response
    {
        $paginationService = $paginationService->setEntityClass(Prodotto::class)->setPage($page);

        //$products = $prodottoRepository->findBy([], ['created_At' => 'DESC'], $limit, $start);

        return $this->render('admin/product/product.html.twig', [
            'products' =>   $paginationService->getData(['created_At' => 'DESC']),
            'paginationService' =>  $paginationService,



        ]);
    }

    /**
     * @Route("/admin/product/{id<\d+>}/delete", name="admin_product_delete")
     */
    public function delete(Prodotto $product, EntityManagerInterface $entityManagerInterface): Response
    {
        if ($product->getPurchaseItems()->count() > 0) {
            $this->addFlash(
                "warning",
                "Nom si puo cancellare un prodotto che contiene delle ordine"
            );
        } else {
            $entityManagerInterface->remove($product);
            $entityManagerInterface->flush();
            $this->addFlash("success", "Il prodotto {$product->getNomeStile()} è stato cancellato");
        }

        return $this->redirectToRoute('admin_product');
    }
}
