<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use App\Models\StoreSettings;
use App\Modules\Cart\Cart;
use App\Modules\Drug\Drug;
use App\Modules\Drug\FOC;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $cart;


    private $drug;

    private $paymentType;

    private $foc;


    /**
     * CartController constructor.
     */
    public function __construct()
    {

        $this->drug = new Drug();
        $this->cart = new Cart($this->drug);
        $this->paymentType = new PaymentType;
        $this->foc = new FOC();
    } // end of constructor function


    public function addToCart(Request $request)
    {
        $drug_store_id = $request->drug_store_id;
        $quantity = $request->quantity ?? 1;

        $validation = $this->validateAddToCartRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'not_found' => false,
                'no_sufficient_amount' => false,
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $drug_store = $this->drug->findDrugStore($drug_store_id); // find drug

        if (!$drug_store) {

            return return_msg(false, 'Not found', [
                'not_found' => true,
                'no_sufficient_amount' => false,
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        $added = $this->cart->add($drug_store, $quantity);

        if (!$added) {

            return return_msg(false, 'No sufficient amount', [
                'not_found' => false,
                'no_sufficient_amount' => true,
                'validation_errors' => []
            ]);
        } // end if

        $cart_items = $this->cart->all();

        return return_msg(true, 'ok', compact('cart_items'));
    }

    /**
     * validate add to cart request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateAddToCartRequest(Request $request)
    {

        return validator($request->all(), [
            'drug_store_id' => 'required',
            'quantity' => 'nullable|numeric'
        ]);
    }

    public function updateCart($cart_data = [])
    {

        foreach ($cart_data as $item) {

            if (!isset($item['drug_store_id']) && !isset($item['drug_store_id'])) {
                continue;
            }

            $drug_store = $this->drug->findDrugStore($item['drug_store_id']);
            if (!$drug_store) {
                continue;
            }

            $this->cart->update($drug_store, $item);
        }

        return return_msg(true, 'ok');
    }

    /**
     * remove item from cart
     *
     * @param int $drug_store_id
     * @return array|null
     */
    public function removeItem(int $drug_store_id)
    {

        $drug_store = $this->drug->findDrugStore($drug_store_id); // find drug
        if (!$drug_store) {

            return return_msg(false, 'Not found', [
                'not_found' => true,
            ]);
        } // end if

        $this->cart->remove($drug_store);

        return return_msg(true, 'ok');
    }

    public function clearCart()
    {

        $this->cart->clear();
        return return_msg(true, 'ok');
    } // end of all function

    /**
     * get all drugs in session [items, out of stock items]
     *
     * @return array|null
     */
    public function all()
    {

        $cart = $this->cart->all();

        $cart_items = $this->assignOrdersToStore($cart);

        foreach ($cart_items as $cart_item) {
            foreach ($cart_item['items'] as $item) {

                $item->foc_categorized = $item->foc->groupBy('foc_on');
            }
        }

        return return_msg(true, 'ok', compact('cart_items'));
    } // end of validateAddToCart request

    protected function assignOrdersToStore($items)
    {

        $items = collect($items);
        $store_items = $items->groupBy(function ($item, $key) {

            return $item->user_id;
        });


        $orders = [];
        foreach ($store_items as $store_id => $items) {

            $store = $items->first()->storeUser;

            $total_store_cost = 0;
            foreach ($items as $item) {

                $total_store_cost += $this->calculateItemPrice($item);
            }

            $orders[] = [
                'store' => $store,
                'items' => $items,
                'total_store_cost' => $total_store_cost
            ];
        }
        return $orders;
    }

    protected function calculateItemPrice($item)
    {


        $item_price = $item->offered_price_or_bonus * $item->quantity;
//        dd($this->foc->getProperDiscountForDrugStore($item->id, $item->quantity));
        $proper_discount = $this->foc->getProperDiscountForDrugStore($item->id, $item->quantity);
        $discount_value = $item_price * ($proper_discount->foc_discount ?? 0) / 100;
        $item_price = $item_price - $discount_value;

        return $item_price;
    }

    public function getChoosingPaymentType()
    {

        $cart = $this->cart->all();

        $cart_items = $this->assignOrdersToStore($cart);

        $payment_types = $this->paymentType->all();


        foreach ($cart_items as $key => $item) {

            unset($cart_items[$key]['items']);

            $item['store']->paymentTypes = count($item['store']->paymentTypes) > 0 ? $item['store']->paymentTypes : $payment_types;
        }

        return $cart_items;
    }

    public function choosePayment(Request $request)
    {

        $choosed_payments = $request->choosed_payments;
        $cart_items = $this->cart->all();
        $cart_items = $this->assignOrdersToStore($cart_items);

        foreach ($cart_items as $key => $cart_item) {
            $store = $cart_item['store'];
            $cart_items[$key]['choosed_payment'] = $this->paymentType->find($choosed_payments[$store->id]['payment_type_id']) ?? null;
            $cart_items[$key]['shipment'] = $choosed_payments[$store->id]['shipment'] ?? null;

            $total_store_cost = 0;
            foreach ($cart_item['items'] as $inner_key => $item) {

                $item_price = $this->calculateItemPrice($item);
                $cart_item['items'][$inner_key]['price'] = $item_price;
                $total_store_cost += $item_price;
            }
            $cart_items[$key]['total_store_cost'] = $total_store_cost;
        }

        foreach ($cart_items as $cart_item) {

            foreach ($cart_item['items'] ?? [] as $item) {

                $item->foc_selected = $item->foc->where('foc_quantity', '>=', $item->quantity)->first();

            }
        }

        session()->put('cart_before_save', $cart_items);

        return return_msg(true, 'ok');
    }

} // end of CartController class
