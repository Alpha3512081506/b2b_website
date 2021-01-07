<?php

namespace App\Controller\Purchase;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchasesListController extends AbstractController
{
    /**
     * @Route("/purchases", name="purchase_index")
     * @IsGranted("ROLE_USER",message="Devi essere loggato per accedere al tuo ordine")
     */
    public function index(): Response
    {
        /** @var User */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute("home_index");
        }

        return $this->render('purchase/index.html.twig', [
            'purchases' => $user->getPurchases()
        ]);
    }
}
