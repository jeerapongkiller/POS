<?php

namespace App\Http\Controllers;

use App\Model\Charge;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    /**
     * Show all sell charge blade view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.charge.charges');
    }

    /**
     * Show new sell charge blade view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newCharge()
    {
        return view('admin.charge.new');
    }

    /**
     * Show edit sell charge blade view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editCharge($id)
    {
        $charge = Charge::findOrFail($id);
        return view('admin.charge.edit',[
            'charge'    =>  $charge
        ]);
    }

    /**
     * Delete a sell charge
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCharge($id)
    {
        if(Charge::destroy($id)){
            return redirect()->back()->with('delete_success','Deleted');
        }
    }

    /**
     * Save a sell charge
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveCharge(Request $request)
    {
        $this->validate($request, [
            'charge_for' => 'required|max:255',
            'charge' => 'required|max:255'
        ]);

        $charge = new Charge();
        $charge->charge_for = $request->get('charge_for');
        $charge->charge = $request->get('charge');
        $charge->user_id = auth()->user()->id;
        if ($charge->save()) {
            return response()->json(["Charge saved","Charge saved successfully"], 200);
        }

    }

    /**
     * Update sell charge
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCharge(Request $request, $id)
    {
        $this->validate($request, [
            'charge_for' => 'required|max:255',
            'charge' => 'required|max:255'
        ]);

        $charge = Charge::findOrFail($id);
        $charge->charge_for = $request->get('charge_for');
        $charge->charge = $request->get('charge');
        $charge->user_id = auth()->user()->id;
        if ($charge->save()) {
            return response()->json("ok", 200);
        }
    }
}
