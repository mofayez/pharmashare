<?php

namespace App\Http\Controllers\Web\Store;

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\PointsController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Controller;
use App\Models\AdsControl;
use App\Modules\User\User as UserModule;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{

    private $user;
    private $cart;
    private $sale;
    private $ads;
    private $points;

    public function __construct()
    {
        $this->user = new UserModule();
        $this->cart = new CartController();
        $this->sale = new SaleController();
        $this->ads = new AdsController();
        $this->points = new PointsController();
    }

    public function addToCart(Request $request)
    {
        return $this->cart->addToCart($request);
    }

    public function emptyCart(Request $request)
    {
        return $this->cart->clearCart();
    }

    public function removeCartItem(Request $request)
    {
        return $this->cart->removeItem($request->drug_store_id);
    }

    public function submitCart(Request $request)
    {
        $drug_store_ids = (array)$request->drug_store_id;
        $quantities = (array)$request->count;
        $focs = (array)$request->focs ?? [];
        $cart_data = [];
        foreach ($drug_store_ids as $k => $id) {
            $cart_data [] = [
                'drug_store_id' => $id,
                'quantity' => $quantities[$k],
                'foc_id' => $focs[$k] ?? null,
            ];
        }


        $response = $this->cart->updateCart($cart_data);

        if ($response['status']) {

            session()->put('cart_submit', true);
            return $response;
        }
        session()->put('cart_submit', false);
        return $response;
    }

    public function viewCart(Request $request)
    {
        $page_title = "viewCart";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $all_cart = [];
        $response = $this->cart->all();

        if ($response['status']) {
            $all_cart = $response['data']['cart_items'];
        }

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $first_ratio = [];
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {
            $first_ratio = $response2['data']['first_ratio'];
            $second_ratio = $response2['data']['second_ratio'];
        }

        $this->points->getPharmacyPoints($request);
//        return $all_cart;
        return view('pages.shopping.cart.index', compact('page_title', 'user', 'all_users', 'all_cart', 'allowed_ads', 'second_ratio', 'first_ratio'));

    }

    public function viewShipping()
    {

        if (session()->has('cart_submit')) {
            if (!session()->get('cart_submit')) {

                return back();
            }
        } else {

            return back();
        }

        $page_title = "viewShipping";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $all_payments = $this->cart->getChoosingPaymentType();

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $first_ratio = [];
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {
            $first_ratio = $response2['data']['first_ratio'];
            $second_ratio = $response2['data']['second_ratio'];
        }

        return view('pages.shopping.shipping.index', compact('page_title', 'user', 'all_users', 'all_payments', 'allowed_ads', 'second_ratio', 'first_ratio'));

    }

    public function submitPayment(Request $request)
    {

        $store_id = (array)$request->store_id;
        $choosed_payments = (array)$request->choosed_payments;
        $shipment = $request->shipment;
        $shipment_data = [];
        foreach ($store_id as $k => $id) {
            $shipment_data [$id] = [
                'payment_type_id' => $choosed_payments[$k],
                'shipment' => $shipment,
            ];
        }
        $request['choosed_payments'] = $shipment_data;
        $response = $this->cart->choosePayment($request);
        if ($response['status']) {

            session()->put('shipment_submit', true);
            return $response;
        }
        session()->put('shipment_submit', false);
        return $response;
    }

    public function viewCheckout()
    {

        if (session()->has('shipment_submit')) {
            if (!session()->get('shipment_submit')) {

                return back();
            }
        } else {

            return back();
        }

        $page_title = "viewShipping";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();

        $cart_before_save = session()->get('cart_before_save') ?? [];

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $first_ratio = [];
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {
            $first_ratio = $response2['data']['first_ratio'];
            $second_ratio = $response2['data']['second_ratio'];
        }

        return view('pages.shopping.checkout.index', compact(
            'page_title', 'user', 'all_users', 'cart_before_save',
            'allowed_ads', 'second_ratio', 'first_ratio'
        ));

    }

    public function submitCheckout(Request $request)
    {
        $request['pharmacy_id'] = auth()->user()->id;
        return $this->sale->placeOrder($request);
    }
}
