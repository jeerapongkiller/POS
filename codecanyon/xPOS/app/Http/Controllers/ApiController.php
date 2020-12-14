<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Charge;
use App\Model\Outlet;
use App\Model\OutletPayment;
use App\Model\Product;
use App\Model\Sell;
use App\Model\UserOutlet;
use App\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Return User as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function users()
    {
        $user = User::where('role', '!=', 4)->where('role','!=',1)->get();
        return datatables($user)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->editColumn('image', function ($user) {
                return view('admin.employee.datatable.image', [
                    'image' => $user->image
                ]);
            })
            ->editColumn('role', function ($user) {
                $role = "";
                if ($user->role == 1) {
                    $role = "Admin";
                } elseif ($user->role == 2) {
                    $role = "Modarator";
                } elseif ($user->role == 3) {
                    $role = "Outlet owner";
                } elseif ($user->role == 4) {
                    $role = "Sells man";
                } else {
                    $role = "We can't recognize";
                }
                return $role;
            })
            ->addColumn('action', 'admin.employee.datatable.action')
            ->rawColumns(['image', 'action'])
            ->make(true);
    }

    /**
     * Return Sell Charges as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function charges()
    {
        $charge = Charge::with('user')->get();
        return datatables($charge)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->addColumn('action', 'admin.charge.datatable.action')
            ->make(true);
    }

    /**
     * Return Outlets as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function outlets()
    {
        $outlet = Outlet::all();

        return datatables($outlet)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->addColumn('outlet_details', function ($outlet) {
                return view('admin.outlet.datatable.outlet-details', [
                    'outlet' => $outlet
                ]);
            })
            ->addColumn('owner_details', function ($outlet) {
                return view('admin.outlet.datatable.outlet-owner', [
                    'outlet' => $outlet
                ]);
            })
            ->addColumn('charges', function ($outlet) {
                return view('admin.outlet.datatable.outlet-charges', [
                    'outlet' => $outlet
                ]);
            })
            ->addColumn('action', 'admin.outlet.datatable.action')
            ->rawColumns(['owner_details', 'outlet_details', 'action', 'charges'])
            ->make(true);
    }

    /**
     * Return Categories by outlet id as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function categories($outlet_id)
    {
        $categories = Category::where('outlet_id', $outlet_id)->get();
        return datatables($categories)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->editColumn('status', function ($cat) {
                if ($cat->status == 1) {
                    return "<span class='label label-success'> <i class='fa fa-check'></i> Active</span>";
                } else {
                    return "<span class='label label-danger'> <i class='fa fa-exclamation'></i> Deactivate</span>";
                }
            })
            ->addColumn('action', function ($cat) {
                return view('owner.product_category.datatable.action', [
                    'cat' => $cat
                ]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Return Product by outlet id as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function products($outlet_id)
    {
        $products = Product::where('outlet_id', $outlet_id)->with('category')->get();
        return datatables($products)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->editColumn('image', function ($product) {
                return view('owner.product.datatable.image', [
                    'product' => $product
                ]);
            })
            ->addColumn('action', function ($product) {
                return view('owner.product.datatable.action', [
                    'product' => $product,
                    'user' => auth()->user()
                ]);
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }

    /**
     * Return Sells man by outlet id as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function sellsMen($outlet_id)
    {
        $user_outlet = UserOutlet::where('outlet_id', $outlet_id)->with('user')->get();
        return datatables($user_outlet)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->addColumn('image', function ($user_outlet) {
                return view('owner.sellsman.datatable.image', [
                    'user_outlet' => $user_outlet
                ]);
            })
            ->addColumn('action', function ($user_outlet) {
                return view('owner.sellsman.datatable.action', [
                    'user_outlet' => $user_outlet
                ]);
            })
            ->editColumn('user_status', function ($user_outlet) {
                if ($user_outlet->user->status == 1) {
                    return "<span class='label label-success'> <i class='fa fa-check'></i> Active</span>";
                } else {
                    return "<span class='label label-danger'> <i class='fa fa-exclamation'></i> Deactivate</span>";
                }
            })
            ->rawColumns(['image', 'action', 'user_status'])
            ->make(true);
    }

    /**
     * Return Sell by outlet id as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function sells($outlet_id)
    {
        $order = Sell::where('outlet_id', $outlet_id)->orderBy('id', 'desc')->get();
        return datatables($order)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->addColumn('customer', function ($order) {
                $customer = $order->customer_id == 0 ? "Walk in customer" : $order->customer->name;
                return $customer;
            })
            ->addColumn('sellsman', function ($order) {
                $sellsman = $order->user_id == 0 ? "Direct Order" : $order->user->name;
                return $sellsman;
            })
            ->addColumn('price', function ($order) {
                $sum = 0;
                foreach ($order->products as $product) {
                    $sum += $product->price * $product->quantity;
                }
                return $sum;
            })
            ->addColumn('gross_price', function ($order) {
                $sum = 0;
                foreach ($order->products as $product) {
                    $sum += $product->price * $product->quantity;
                }
                $tax = ($sum * $order->vat) / 100;
                return $sum + $tax;
            })
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('d-M-Y');
            })
            ->addColumn('action', function ($order) {
                return view('owner.sell.datatable.action', [
                    'order' => $order
                ]);
            })
            ->editColumn('status', function ($order) {
                return $order->status == 1 ? 'Paid' : 'Due';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Return Outlet Payments by outlet id as JSON and show it at jQuery Datatables
     * @return mixed
     */
    public function outletPayments($outlet_id)
    {
        $payment = OutletPayment::where('outlet_id',$outlet_id)->orderBy('id','desc')->with('user')->get();
        return datatables($payment)
            ->addColumn('#', function () {
                static $i = 1;
                return $i++;
            })
            ->editColumn('created_at',function ($payment){
                return $payment->created_at->format('d-M-Y');
            })
            ->make(true);
    }
}
