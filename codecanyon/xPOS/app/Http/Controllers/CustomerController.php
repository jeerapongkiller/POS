<?php

namespace App\Http\Controllers;

use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Save customer only if phone number is not exist.
     *
     * @param Request $request
     * @param $outlet_id
     * @return Customer|\Illuminate\Http\JsonResponse
     */
    public function saveCustomer(Request $request,$outlet_id)
    {
        $this->validate($request,[
           'name'   =>  'required',
           'phone'  =>  'required'
        ]);

        if($this->customerPhoneExist($request,$outlet_id)){
            $customer = Customer::where('outlet_id',$outlet_id)
                ->where('phone',$request->get('phone'))
                ->first();
            return response()->json($customer,200);
        }else{
            $customer = new Customer();
            $customer->outlet_id = $outlet_id;
            $customer->name = $request->get('name');
            $customer->phone = $request->get('phone');
            $customer->email = $request->get('email');
            $customer->address = $request->get('address');
            if(auth()->check()){
                $customer->user_id = auth()->user()->id;
            }
            if($customer->save()){
                return $customer;
                return response()->json($customer,200);
            }
        }
    }


    /**
     * Check customer phone number exist or not
     *
     * @param Request $request
     * @param $outlet_id
     * @return bool
     */
    private function customerPhoneExist(Request $request,$outlet_id)
    {
        $customer = Customer::where('outlet_id',$outlet_id)
            ->where('phone',$request->get('phone'))
            ->get();
        if(count($customer) == 0){
            return false;
        }else{
            return true;
        }
    }
}
