<?php

namespace App\Cart;

use App\Cart\CartItem;
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
        $cart = $this->sessionInterface->get('cart', []);
        foreach ($cart as $id => $quantity) {
            $product = $this->prodottoRepository->find($id);
            if (!$product) {
                continue;
            }
            $total += $product->getPrezzo() * $quantity;
        }
        return $total;
    }
    /**
     * @return array<CartItem>
     */
    public function getDetailCartItems(): array
    {
        $detailCart = [];
        $cart = $this->sessionInterface->get('cart', []);
        foreach ($cart as $id => $quantity) {
            $product = $this->prodottoRepository->find($id);
            if (!$product) {
                continue;
            }
            $detailCart[] = new CartItem($product, $quantity);
        }
        return $detailCart;
    }
    public function delete($id)
    {
        $cart = $this->sessionInterface->get("cart", []);
        unset($cart[$id]);
        return $this->sessionInterface->set("cart",  $cart);
    }
    public function decrement($id)
    {
        $cart = $this->sessionInterface->get('cart', []);
        if (!array_key_exists($id, $cart)) {
            return;
        } elseif ($cart[$id] === 1) {
            $this->remove();
        } else
            $cart[$id]--;

        $this->sessionInterface->set('cart', $cart);
    }
    public function remove()
    {

        return $this->sessionInterface->remove('cart');
    }
    public function saveCart(array $cart)
    {

        $this->sessionInterface->set('cart', $cart);
    }

    public function empty()
    {

        $this->saveCart([]);
    }
}
