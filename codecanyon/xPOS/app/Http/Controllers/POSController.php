<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Customer;
use App\Model\OutletCharge;
use App\Model\OutletTax;
use App\Model\Product;
use App\Model\Sell;
use App\Model\SellCharge;
use App\Model\SellPayment;
use App\Model\SellProduct;
use Illuminate\Http\Request;

class POSController extends Controller
{
    /**
     * Show POS
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newSell($outlet_id)
    {
        $categories = Category::where('outlet_id', $outlet_id)->get();
        $products = Product::where('outlet_id', $outlet_id)->get();
        $tax = OutletTax::where('outlet_id',$outlet_id)->first();
        $customers = Customer::where('outlet_id',$outlet_id)->cursor();
        return view('outlet.sells.new-sell', [
            'outlet_id'     =>      $outlet_id,
            'categories'    =>      $categories,
            'products'      =>      $products,
            'tax'           =>      $tax,
            'customers'     =>      $customers
        ]);
    }

    /**
     * Get outlet products by outlet id
     *
     * @param $outlet_id
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductById($outlet_id, $product_id)
    {
        $product = Product::select('id', 'product_name', 'product_sku', 'price')
            ->where('outlet_id', $outlet_id)
            ->where('id', $product_id)
            ->first();
        return response()->json($product);
    }

    /**
     * Get outlet product by product sku
     *
     * @param Request $request
     * @param $outlet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductBySku(Request $request, $outlet_id)
    {
        $this->validate($request, [
            'product_sku' => 'required'
        ]);

        $product = Product::select('id', 'product_name', 'product_sku', 'price')
            ->where('outlet_id', $outlet_id)
            ->where('product_sku', $request->product_sku)
            ->first();
        if ($product) {
            return response()->json($product, 200);
        } else {
            return response()->json(['Product not found', 'Product not found'], 404);
        }
    }

    /**
     * Get hold order by outlet
     *
     * @param $outlet_id
     * @return mixed
     */
    public function getHoldOrders($outlet_id)
    {
        $hold_orders = Sell::where('outlet_id', $outlet_id)
            ->where('status', 0)
            ->where('order_type',1)
            ->with('products')
            ->with('customer')
            ->get();
        return $hold_orders;
    }

    /**
     * Get customer orders by customer id
     *
     * @param $outlet_id
     * @return mixed
     */
    public function getCustomerOrders($outlet_id)
    {
        $hold_orders = Sell::where('outlet_id', $outlet_id)
            ->where('status', 0)
            ->where('order_type',2)
            ->with('products')
            ->with('customer')
            ->get();
        return $hold_orders;
    }


    /**
     * Save due orders by outlet id
     *
     * @param Request $request
     * @param $outlet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function dueOrder(Request $request, $outlet_id)
    {
        if ($request->get('sell_order') == 0) {
            $sell = new Sell();
            $sell->vat = $request->get('tax');
            $sell->sell_charges = OutletCharge::where('outlet_id',$outlet_id)->sum('charge');
        } else {
            $sell = Sell::findOrFail($request->get('sell_order'));
        }
        $sell->outlet_id = $outlet_id;
        $sell->ref_number = $request->get('ref_number') == '' ? rand(100000, 900000) : $request->get('ref_number');
        $sell->status = $request->get('status');
        $sell->order_type = $request->get('order_type');
        $sell->discount = $request->get('discount') == '' ? 0 : $request->get('discount');
        $sell_value = 0;
        foreach ($request->get('products') as $product) {
            $sell_value +=  $product['quantity'] *  $product['price'];
        }
        $sell->sell_value = $sell_value;
        $sell->customer_id = $request->get('customer_id');
        $sell->user_id = auth()->user()->id;
        if ($sell->save()) {
            $this->saveSellProduct($request, $sell->id);
            $this->saveSellCharge($request->get('sell_order'), $sell->id, $outlet_id);
            if($sell->status == 1){
                $this->saveSellPayment($request,$sell->id);
            }
            return response()->json($sell,200);
        }
    }


    /**
     * Save customer order
     *
     * @param Request $request
     * @param $outlet_id
     */
    public function customerOrder(Request $request, $outlet_id)
    {
        $sell = new Sell();
        $sell->vat = $request->get('tax');
        $sell->outlet_id = $outlet_id;
        $sell->ref_number = $request->get('ref_number') == '' ? rand(100000, 900000) : $request->get('ref_number');
        $sell->status = $request->get('status');
        $sell->order_type = $request->get('order_type');
        $sell->discount = $request->get('discount') == '' ? 0 : $request->get('discount');
        $sell->customer_id = $request->get('customer_id');
        $sell->user_id = 0;
        if ($sell->save()) {
            $this->saveSellProduct($request, $sell->id);
            $this->saveSellCharge($request->get('sell_order'), $sell->id, $outlet_id);
        }
    }

    /**
     * Save sell product
     *
     * @param Request $request
     * @param $sell_id
     */
    private function saveSellProduct(Request $request, $sell_id)
    {
        $this->deleteSellProduct($sell_id);
        foreach ($request->get('products') as $product) {
            $sell_product = new SellProduct();
            $sell_product->sell_id = $sell_id;
            $sell_product->product_id = $product['id'];
            $sell_product->quantity = $product['quantity'];
            $sell_product->price = $product['price'];
            $sell_product->save();
        }
    }

    /**
     * Save sell charge
     *
     * @param $sell_order
     * @param $sell_id
     * @param $outlet_id
     */
    private function saveSellCharge($sell_order, $sell_id, $outlet_id)
    {
        if ($sell_order == 0) {
            $this->deleteSellCharge($sell_id);
            $outlet_charges = OutletCharge::where('outlet_id', $outlet_id)->get();
            foreach ($outlet_charges as $charge) {
                $sell_charge = new SellCharge();
                $sell_charge->sell_id = $sell_id;
                $sell_charge->outlet_id = $outlet_id;
                $sell_charge->charge = $charge->outletCharge->charge;
                $sell_charge->charge_for = $charge->outletCharge->charge_for;
                $sell_charge->save();
            }
        }

    }

    /**
     * Save sell payment
     *
     * @param Request $request
     * @param $sell_id
     */
    private function saveSellPayment(Request $request,$sell_id)
    {
        $sell_payment = new SellPayment();
        $sell_payment->sell_id = $sell_id;
        $sell_payment->payment_type = $request->get('payment_type');
        $sell_payment->payment_info = $request->get('payment_info');
        $sell_payment->cash_journal = $request->get('cash_journal');
        $sell_payment->change   = $request->get('change');
        $sell_payment->payment = $request->get('cash_journal') + $request->get('change');
        $sell_payment->user_id = auth()->user()->id;
        $sell_payment->save();
    }

    /**
     * Delete sell product
     *
     * @param $sell_id
     */
    private function deleteSellProduct($sell_id)
    {
        $sell_product = SellProduct::where('sell_id', $sell_id)->delete();
    }

    /**
     * delete sell charge
     *
     * @param $sell_id
     */
    private function deleteSellCharge($sell_id)
    {
        $sell_charge = SellCharge::where('sell_id', $sell_id)->delete();
    }

    /**
     * delete order
     *
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteOrder($outlet_id, $id)
    {
        $this->deleteSellProduct($id);
        if (Sell::destroy($id)) {
            return response()->json('Deleted', 200);
        }
    }

    /**
     * Print sell order
     *
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function printOrder($outlet_id, $id)
    {
        $order = Sell::findOrFail($id);
        $tax = OutletTax::where('outlet_id',$outlet_id)->first();
        return view('outlet.sells.print-order', [
            'order' =>  $order,
            'tax'   =>  $tax
        ]);
    }

    /**
     * Show sell history
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sells($outlet_id)
    {
        return view('owner.sell.sells',[
            'outlet_id' =>  $outlet_id
        ]);
    }
}
