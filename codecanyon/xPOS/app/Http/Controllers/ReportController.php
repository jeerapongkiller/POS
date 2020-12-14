<?php

namespace App\Http\Controllers;

use App\Model\Outlet;
use App\Model\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Show outlet sell report by date
     *
     * @param $outlet_id
     * @param $start_date
     * @param $end_date
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function outletSellReport($outlet_id, $start_date, $end_date, $type)
    {
        if(\DateTime::createFromFormat('Y-m-d',$start_date) == FALSE || \DateTime::createFromFormat('Y-m-d',$end_date) == FALSE){
           return redirect()->back();
        }
        if(is_integer($type)){
            if($type == 0){

            }elseif ($type == 1){

            }else{
                $type = 0;
            }
        }

        return view('owner.report.sell.main', [
            'outlet_id'     =>  $outlet_id,
            'type'          =>  $type,
            'start_date'    =>  $start_date,
            'end_date'      =>  $end_date
        ]);
    }

    /**
     * Show outlet payment report by date
     *
     * @param $outlet_id
     * @param $start_date
     * @param $end_date
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function outletPaymentReport($outlet_id,$start_date,$end_date,$type)
    {
        if(\DateTime::createFromFormat('Y-m-d',$start_date) == FALSE || \DateTime::createFromFormat('Y-m-d',$end_date) == FALSE){
            return redirect()->back();
        }
        if(is_integer($type)){
            if($type == 0){

            }elseif ($type == 1){

            }else{
                $type = 0;
            }
        }

        return view('owner.report.payment.main',[
            'outlet_id'     =>  $outlet_id,
            'type'          =>  $type,
            'start_date'    =>  $start_date,
            'end_date'      =>  $end_date
        ]);
    }


    /**
     * Payment report for admin
     *
     * @param $outlet_id
     * @param $start_date
     * @param $end_date
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentReport($outlet_id,$start_date,$end_date,$type)
    {
        $outlets = Outlet::all();
        return view('admin.report.payment.main',[
            'outlet_id'     =>  $outlet_id,
            'type'          =>  $type,
            'start_date'    =>  $start_date,
            'end_date'      =>  $end_date,
            'outlets'       =>  $outlets
        ]);
    }
}
