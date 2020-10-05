<?php

namespace App\Models;

class Cart
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $stockAmount = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($qty, $item, $id, $stock) {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'stock' => $stock, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] = $storedItem['qty'] + $qty;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty = $this->totalQty + $qty;
        $this->totalPrice += $item->price * $qty;
    }
}
