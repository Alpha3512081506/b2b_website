<?php

namespace App\Controller\Purchase;

use App\Cart\CartService;
use App\Entity\Purchase;
use App\Entity\PurchaseItem;
use App\Form\CartConfirmationType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryBuilder;
use Symfony\Component\Form\FormFactoryInterface;

class PurchaseConfirmationController extends AbstractController
{
    private $cartService;
    private $formFactoryInterface;
    private $em;
    public function __construct(CartService $cartService, FormFactoryInterface $formFactoryInterface, EntityManagerInterface $entityManagerInterface)
    {
        $this->cartService = $cartService;
        $this->formFactoryInterface = $formFactoryInterface;
        $this->em = $entityManagerInterface;
    }
    /**
     * @Route("/purchase/confirm", name="purchase_confirm")
     * IsGranted("Devi essere collegato per accedere a questa rissorsa")
     */
    public function confirm(Request $request)
    {
        $purchase = new Purchase;
        $formConfirm = $this->formFactoryInterface->create(CartConfirmationType::class);

        $formConfirm->handleRequest($request);
        if (!$formConfirm->isSubmitted()) {
            $this->addFlash('warning', 'Devi compilare il modulo di confermation');
            return  $this->redirectToRoute("cart_show");
        }

        $cartItems = $this->cartService->getDetailCartItems();
        if (count($cartItems) === 0) {
            $this->addFlash('warning', 'non si puo confermare un ordine con il carello vuoto');
            return $this->redirectToRoute("cart_show");
        }
        /**@var Purchase */
        $purchase = $formConfirm->getData();
        $purchase->setPurchaseAt(new DateTime());
        $this->em->persist($purchase);
        $user = $this->getUser();
        $purchase->setUser($user)
            ->setTotal($this->cartService->getTotal());


        foreach ($this->cartService->getDetailCartItems() as $cartItem) {
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
                ->setProduct($cartItem->product)
                ->setProductName($cartItem->product->getNomeStile())
                ->setQuantity($cartItem->quantity)
                ->setTotal($cartItem->getTotal())
                ->setProductPrice($cartItem->product->getPrezzo());
            $this->em->persist($purchaseItem);
        }

        $this->em->flush();
        $this->cartService->empty();
        $this->addFlash('success', 'Il suo ordine è stato salvato');
        return $this->redirectToRoute('purchase_index');
    }
}
