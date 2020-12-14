<?php

namespace App\Http\Controllers;

use App\Model\Outlet;
use App\Model\OutletPayment;
use Illuminate\Http\Request;

class OutletPaymentController extends Controller
{
    /**
     * Show new payment
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newPayment($id)
    {
        $outlet = Outlet::findOrFail($id);
        return view('admin.outlet.payment.new-payment',[
            'outlet'    =>  $outlet
        ]);
    }

    /**
     * Save outlet payment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePayment(Request $request)
    {
        $outlet_payment = new OutletPayment();
        $outlet_payment->outlet_id = $request->get('outlet_id');
        $outlet_payment->payable_amount = $request->get('payable_amount');
        $outlet_payment->payment    =  $request->get('payment');
        $outlet_payment->due_amount = $request->get('payable_amount') - $request->get('payment');
        $outlet_payment->note   = $request->get('note');
        $outlet_payment->user_id    = auth()->user()->id;
        if($outlet_payment->save()){
            return redirect()->back()->with('success','Payment success');
        }
    }

    /**
     * Show outlet payment history by outlet id
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function outletPaymentHistory($outlet_id)
    {
        $outlet = Outlet::findOrFail($outlet_id);
        return view('admin.outlet.payment.payments',[
            'outlet'    =>  $outlet
        ]);
    }
}
