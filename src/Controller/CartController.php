<?php

namespace App\Controller;

use App\Cart\CartService;
use App\Form\CartConfirmationType;
use App\Repository\ProdottoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add",requirements={"id":"\d+"})
     */
    public function add($id, ProdottoRepository $prodottoRepository, CartService $cartService, Request $request): Response
    {
        $product = $prodottoRepository->find($id);
        if (!$product) {
            throw $this->createNotFoundException("il prodotto $id non esiste");
        }
        $cartService->add($id);

        $this->addFlash('success', 'Il prodotto é stato aggiunto al carello');
        if ($request->query->get("returnToCart")) {
            return $this->redirectToRoute("cart_show");
        }
        return $this->redirectToRoute('prodotto_show', [
            'slug_categoria' => $product->getCategoria()->getSlug(),
            'slug_prodotto' => $product->getSlug()
        ]);
    }
    /**
     * @Route("/cart",name="cart_show")
     */
    public function show(CartService $cartService)
    {
        $form = $this->createForm(CartConfirmationType::class);

        $detailCart = $cartService->getDetailCartItems();
        $total = $cartService->getTotal();
        return $this->render("cart/index.html.twig", [
            'items' => $detailCart,
            'total' => $total,
            'confirmationform' => $form->createView()
        ]);
    }
    /**
     * @Route("/cart/delete/{id}", name="cart_delete",requirements={"id":"\d+"})
     */
    public function delete($id, ProdottoRepository $prodottoRepository, CartService $cartService)
    {
        $product = $prodottoRepository->find($id);
        if (!$product) {
            throw $this->createNotFoundException("il prodotto $id non esiste e non può essere eliminato");
        }
        $cartService->remove($id);
        $this->addFlash("success", "il prodotto è stato eliminato del carrello");
        return $this->redirectToRoute("cart_show");
    }
    /**
     * @Route("/cart/decrement/{id}", name="cart_decrement", requirements={"id":"\d+"})
     */
    public function decrement(int $id, CartService $cartService, ProdottoRepository $prodottoRepository)
    {
        $product = $prodottoRepository->find($id);
        if (!$product) {
            throw $this->createNotFoundException("il prodotto $id non esiste e non può essere decrementato");
        }
        $cartService->decrement($id);
        return $this->redirectToRoute("cart_show");
    }
}
