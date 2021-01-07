<?php

namespace App\Controller\Purchase;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseConfirmationController extends AbstractController
{
    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     */
    public function index(): Response
    {
        return $this->render('purchase/purchase_confirmation/index.html.twig', [
            'controller_name' => 'PurchaseConfirmationController',
        ]);
    }
}
