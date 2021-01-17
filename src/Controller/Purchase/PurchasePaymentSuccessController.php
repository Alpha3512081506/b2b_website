<?php

namespace App\Controller\Purchase;

use App\Entity\Purchase;
use App\Cart\CartService;
use App\Event\PurchaseSuccessEvent;
use App\Repository\PurchaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PurchasePaymentSuccessController extends AbstractController
{
    /**
     * @Route("/purchase/terminate/{id}", name="purchase_payment_success")
     * IsGranted("ROLE_USER")
     */
    public function success(
        $id,
        PurchaseRepository $purchaseRepository,
        EntityManagerInterface $entityManagerInterface,
        CartService $cartService,
        EventDispatcherInterface $dispatcherInterface
    ): Response {
        $purchase = $purchaseRepository->find($id);
        if (
            !$purchase ||
            ($purchase && $purchase->getUser() != $this->getUser()) ||
            ($purchase->getStatus() === Purchase::STATUS_PAID)
        ) {
            $this->addFlash('warning', " ordine non esiste !");
            return $this->redirectToRoute("purchase_index");
        }
        $purchase->setStatus(Purchase::STATUS_PAID);
        $entityManagerInterface->flush();
        $cartService->empty();
        //Lancer un evenent qui permer de reagir a la price d'une commande
        $purchaseEvent = new PurchaseSuccessEvent($purchase);
        $dispatcherInterface->dispatch($purchaseEvent, 'purchase.succes');
        $this->addFlash("success", "L'ordine è stato pagato e confermato");
        return $this->redirectToRoute("purchase_index");
    }
}
