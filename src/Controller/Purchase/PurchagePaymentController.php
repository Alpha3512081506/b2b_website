<?php

namespace App\Controller\Purchase;

use App\Repository\PurchaseRepository;
use App\Stripe\StripeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchagePaymentController extends AbstractController
{
    /**
     * @Route("/purchase/pay/{id}", name="purchase_payment_form")
     */
    public function showCardForm($id, PurchaseRepository $purchaseRepository, StripeService $stripeService): Response
    {
        $purchase = $purchaseRepository->find($id);
        if (!$purchase) {
            return $this->redirectToRoute("cart_show");
        }

        $intent = $stripeService->getPaymentIntente($purchase);

        return $this->render('purchase/payment.html.twig', [
            'clientSecret' => $intent->client_secret,
            'purchase' =>  $purchase,
            'stripePublickey' => $stripeService->getPublicKey()
        ]);
    }
}
