<?php

namespace App\Cart;

use App\Entity\Prodotto;

class CartItem
{
    public $product;
    public  $quantity;
    public function __construct(Prodotto $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
    public function getTotal()
    {
        return $this->product->getPrezzo() * $this->quantity;
    }
}
