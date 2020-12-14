<?php

namespace App\Http\Controllers;

use App\Model\Charge;
use App\Model\Customer;
use App\Model\Outlet;
use App\Model\OutletCharge;
use App\Model\OutletPayment;
use App\Model\OutletTax;
use App\User;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Show outlets
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.outlet.outlets');
    }

    /**
     * Show new outlet from
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newOutlet()
    {
        $user = User::where('role', 3)->get();
        $charges = Charge::all();
        return view('admin.outlet.new', [
            'users' => $user,
            'charges' => $charges
        ]);
    }

    /**
     * Show edit outlet from
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editOutlet($id)
    {
        $outlet = Outlet::findOrFail($id);
        $user = User::where('role',3)->get();
        $charges = Charge::all();
        return view('admin.outlet.edit', [
            'users'     => $user,
            'charges'   => $charges,
            'outlet'    =>  $outlet
        ]);
    }

    /**
     * Delete an outlet by outlet id
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteOutlet($id)
    {
        if(Outlet::destroy($id)){
            return redirect()->back()->with('delete_success','Outlet Deleted');
        }
    }

    /**
     * Save an outlet
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveOutlet(Request $request)
    {
        $outlet = new Outlet();
        $outlet->outlet_name = $request->get('outlet_name');
        $outlet->location = $request->get('location');
        $outlet->rent = $request->get('rent');
        $outlet->owner_id = $request->get('owner');
        $outlet->user_id = auth()->user()->id;
        if ($request->hasFile('logo')) {
            $outlet->logo = $request->file('logo')
                ->move('uploads/outlet_logo', rand(100000, 900000) . '.' . $request->photo->extension());
        }
        if ($outlet->save()) {
            $outlet_tax = new OutletTax();
            $outlet_tax->outlet_id = $outlet->id;
            $outlet_tax->tax_id = $request->get('tin') != '' ? $request->get('tin') : config('app.tin');
            $outlet_tax->tax = $request->get('tax') != '' ? $request->get('tax') : config('app.tax');
            $outlet_tax->user_id = auth()->user()->id;
            $outlet_tax->save();
            if (count($request->get('charge')) != 0) {
                foreach ($request->get('charge') as $charge) {
                    $this->saveOutletCharges($outlet->id, $charge);
                }
            }
            return response()->json(['Outlet saved','Outlet Saved successfully'],200);
        }
    }

    /**
     * Save outlet charge by outlet id
     *
     * @param $outlet_id
     * @param $charge_id
     */
    private function saveOutletCharges($outlet_id, $charge_id)
    {
        $charge = Charge::findOrFail($charge_id);
        $outletCharge = new OutletCharge();
        $outletCharge->outlet_id = $outlet_id;
        $outletCharge->charge_id = $charge_id;
        $outletCharge->charge = $charge->charge;
        $outletCharge->user_id = auth()->user()->id;
        $outletCharge->save();
    }

    /**
     * Update an outlet
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOutlet(Request $request, $id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->outlet_name = $request->get('outlet_name');
        $outlet->location = $request->get('location');
        $outlet->rent = $request->get('rent');
        $outlet->owner_id = $request->get('owner');
        $outlet->user_id = auth()->user()->id;
        if ($request->hasFile('logo')) {
            $outlet->logo = $request->file('logo')
                ->move('uploads/outlet_logo', rand(100000, 900000) . '.' . $request->photo->extension());
        }
        if($outlet->save()){
            $outlet_tax = OutletTax::where('outlet_id',$id)->first();
            $outlet_tax->tax_id = $request->get('tin');
            $outlet_tax->tax = $request->get('tax');
            $outlet_tax->user_id = auth()->user()->id;
            $outlet_tax->save();
            $this->removeOutletCharges($id);
            if (count($request->get('charge')) != 0) {
                foreach ($request->get('charge') as $charge) {
                    $this->saveOutletCharges($outlet->id, $charge);
                }
            }
            return response()->json(['Outlet updated','Outlet updated successfully'],200);

        }

    }

    /**
     * Remove outlet charges
     *
     * @param $outlet_id
     */
    private function removeOutletCharges($outlet_id)
    {
        OutletCharge::where('outlet_id',$outlet_id)->delete();
    }

    /**
     * Show outlet charges
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function outletCharge()
    {
        $outlets = Outlet::where('status',1)->get();
        return view('admin.outlet.charge-cost.charge',[
           'outlets'    =>  $outlets
        ]);
    }

    /**
     * Show sell charges
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sellCharge($outlet_id)
    {
        $outlet = Outlet::findOrFail($outlet_id);
        return view('owner.sell-charge.charges',[
            'outlet_id' =>  $outlet_id,
            'outlet'    =>  $outlet
        ]);
    }

    /**
     * Show outlet payment history
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function outletPayment($outlet_id)
    {
        return view('owner.sell-charge.payment',[
            'outlet_id' =>  $outlet_id
        ]);
    }




}
