<?php

namespace App\Cart;

use App\Repository\ProdottoRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $sessionInterface;
    private $prodottoRepository;
    public function __construct(SessionInterface $sessionInterface, ProdottoRepository $prodottoRepository)
    {
        $this->sessionInterface = $sessionInterface;
        $this->prodottoRepository = $prodottoRepository;
    }
    public function add($id)
    {

        $cart = $this->sessionInterface->get('cart', []);
        if (array_key_exists($id, $cart)) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $this->sessionInterface->set('cart', $cart);
    }
    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->sessionInterface->get('cart', []) as $id => $quantity) {
            $product = $this->prodottoRepository->find($id);
            if (!$product) {
                continue;
            }
            $total += $product->getPrezzo() * $quantity;
        }
        return $total;
    }
    public function getDetailCartItems(): array
    {
        $detailCart = [];
        foreach ($this->sessionInterface->get('cart', []) as $id => $quantity) {
            $product = $this->prodottoRepository->find($id);
            if (!$product) {
                continue;
            }
            $detailCart[] = new CartItem($product, $quantity) /* [
                'product' => $product,
                'quantity' => $quantity

            ]; */;
        }
        return $detailCart;
    }
    public function remove($id)
    {
        $cart = $this->sessionInterface->get("cart", []);
        unset($cart[$id]);
        $this->sessionInterface->set("cart",  $cart);
    }
    public function decrement($id)
    {
        $cart = $this->sessionInterface->get('cart', []);
        if (!array_key_exists($id, $cart)) {
            return;
        }
        if ($cart[$id] === 1) {
            $this->remove($id);
        }
        $cart[$id]--;

        $this->sessionInterface->set('cart', $cart);
    }
}
