<?php

namespace App\Modules\Cart;

use App\Modules\Drug\Drug;

class Cart
{

    /**
     * Instance of Product.
     */
    protected $product;

    /**
     * @var CartSessionStorage
     */
    private $storage;


    public function __construct(Drug $drug)
    {
        $this->storage = new CartSessionStorage();
        $this->product = $drug;
    }

    /**
     * Add the product with its quantity to the basket.
     * The quantity will be updated if it exists.
     *
     * @param $product
     * @param $quantity
     * @return bool
     */
    public function add($product, $quantity = 1)
    {
        if ($this->has($product)) {
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        return $this->update($product, $quantity);
    }

    /**
     * Check if the basket has a certain product.
     *
     * @param $product
     * @return mixed
     */
    public function has($product)
    {
        return $this->storage->exists($product->id);
    }


    /**
     * Get a product that is inside the basket.
     *
     * @param $product
     * @return mixed|null
     */
    public function get($product)
    {
        return $this->storage->get($product->id);
    }


    /**
     * Update the basket.
     *
     * @param $product
     * @param $quantity
     * @return bool
     */
    public function update($product, $quantity)
    {
        $product_date = [];

        if (!$product->hasStock($quantity) || !$product->outOfStock()) {

//            return false;
            $product->out_of_stock = true;
        }

        if ($quantity == 0) {
            $this->remove($product);

            return true;
        }

        $this->storage->set($product->id, [
            'product_id' => (int)$product->id,
            'quantity' => (int)$quantity,
            'out_of_stock' => $product->out_of_stock,
        ]);

        return true;
    }


    /**
     * Remove a from the storage.
     *
     * @param $product
     * @return bool
     */
    public function remove($product)
    {
        $this->storage->remove($product->id);

        return true;
    }


    /**
     * Clear the basket.
     */
    public function clear()
    {
        return $this->storage->clear();
    }


    /**
     * Get the amount of products inside the basket.
     */
    public function itemCount()
    {
        return count($this->storage->all()['items']);
    }

    /**
     * Get the subtotal price of all products inside the basket.
     */
    public function subTotal()
    {
        $total = 0;
        foreach ($this->all()['items'] as $item) {
            if ($item->outOfStock()) {
                continue;
            }

            $total += ($this->computeProductCost($item));
        }

        return $total;
    }

    /**
     * Get all products inside the basket.
     */
    public function all()
    {
        $ids = [];
        $items = [];
        $out_of_stock = [];

        foreach ($this->storage->all() as $product) {
            $ids[] = $product['product_id'];
        }

        $products = $this->product->findBunchStore($ids);

        foreach ($products as $product) {
            $product->quantity = $this->get($product)['quantity'];
            $product->cost = $this->computeProductCost($product);

            if (!$product->hasStock($product->quantity)) {

                $product->hasStock = false;
//                $items[] = $product;
//                continue;
            }
            $product->hasStock = true;
            $items[] = $product;

//            $out_of_stock[] = $product;
        }

        return $items;
//        return [
//            'items' => array_values($items),
//            'out_of_stock' => $out_of_stock
//        ];
    }

    /**
     * Check if the items in the basket are still in stock.
     */
    public function refresh()
    {
        foreach ($this->all()['items'] as $item) {
            if (!$item->hasStock($item->quantity)) {
                $this->update($item, $item->stock);
            }
        }
    }


    public function outOfStockItems()
    {

        $ids = [];
        $items = [];

        foreach ($this->storage->all() as $product) {
            $ids[] = $product['product_id'];
        }

        $products = $this->product->findBunchStore($ids);

        foreach ($products as $product) {
            $product->quantity = $this->get($product)['quantity'];
            $product->cost = $this->computeProductCost($product);

            if (!$product->hasStock($product->quantity)) {

                $product->hasStock = false;
            }
        }

        return $items;
    }


    public function computeProductCost($product)
    {

        return $product->quantity * $product->offered_price_or_bonus;
    }

} // end of Cart class