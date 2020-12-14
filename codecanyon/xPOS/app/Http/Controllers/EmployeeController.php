<?php

namespace App\Http\Controllers;

use App\Model\Outlet;
use App\Model\UserOutlet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Show employee blade
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.employee.employees');
    }

    /**
     * Show new employee blade
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newEmployee()
    {
        return view('admin.employee.new');
    }

    /**
     * Edit selected employee by employee id
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editEmployee($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.employee.edit',[
            'employee'  =>  $employee
        ]);
    }

    /**
     * Delete selected employee by employee id
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEmployee($id)
    {
        if(User::destroy($id)){
            return redirect()->back()->with('delete_success','User has been deleted successfully');
        }
    }

    /**
     * Save new employee
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveEmployee(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:20',
            'phone' => 'required|unique:users|max:255',
            'address' => 'required'
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->phone = $request->get('phone');
        $user->additional_phone = $request->get('additional_phone');
        $user->role = $request->get('role');
        $user->address = $request->get('address');
        if ($request->hasFile('photo')) {
            $user->image = $request->file('photo')
                ->move('uploads/user', str_random(40) . '.' . $request->photo->extension());
        }
        if ($user->save()) {
            return response()->json(['User saved','User has been created successfully'], 200);
        }
    }


    /**
     * Update an employee by employee id
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEmployee(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required', Rule::unique('users')->ignore($id, 'id'),
            'phone' => 'required', Rule::unique('users')->ignore($id, 'id'),
            'address' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password') != "") {
            $user->password = Hash::make($request->get('password'));
        }
        $user->phone = $request->get('phone');
        $user->additional_phone = $request->get('additional_phone');
        $user->role = $request->get('role');
        $user->address = $request->get('address');
        if ($request->hasFile('photo')) {
            $user->image = $request->file('photo')
                ->move('uploads/user', str_random(40) . '.' . $request->photo->extension());
        }
        $user->status = $request->get('status') == 'on' ? 1 : 0;
        if ($user->save()) {
            return response()->json(['User updated','User has been updated successfully'], 200);
        }
    }


    /*******************************************************************************************************
     * ****************************    Outlet Owner Segment ************************************************
     * ****************************         Start hear      ************************************************
     *******************************************************************************************************/


    /**
     * Show sells man blade view
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sellsMen($outlet_id)
    {
        return view('owner.sellsman.sellsmen', [
            'outlet_id' => $outlet_id
        ]);
    }


    /**
     * Show new sells man blade view
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newSellsMan($outlet_id)
    {
        $outlets = Outlet::where('owner_id', auth()->user()->id)->get();
        return view('owner.sellsman.new', [
            'outlet_id' => $outlet_id,
            'outlets' => $outlets
        ]);
    }

    /**
     * Show sells man details in edit sells man blade view
     *
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSellsMan($outlet_id, $id)
    {
        $outlets = Outlet::where('owner_id', auth()->user()->id)->get();
        $user = User::findOrFail($id);
        return view('owner.sellsman.edit', [
            'outlet_id' => $outlet_id,
            'outlets' => $outlets,
            'user' => $user
        ]);
    }

    /**
     * Save new sells man
     *
     * @param Request $request
     * @param $outlet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveSellsMan(Request $request, $outlet_id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|unique:users|max:100',
            'password' => 'required|max:20',
            're-password' => 'required|max:20'
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->phone = $request->get('phone');
        $user->additional_phone = $request->get('additional_phone');
        $user->address = $request->get('address');
        $user->role = 4;
        if ($request->hasFile('photo')) {
            $user->image = $request->file('photo')
                ->move('uploads/user', str_random(40) . '.' . $request->photo->extension());
        }
        if ($user->save()) {
            $userOutlet = new UserOutlet();
            $userOutlet->user_id = $user->id;
            $userOutlet->outlet_id = $request->get('outlet_id');
            if ($userOutlet->save()) {
                return response()->json(['Sells Man Added', 'Sells man has been saved successfully'], 200);
            }
        }
    }

    /**
     * Update a sells man by id
     *
     * @param Request $request
     * @param $outlet_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSellsMan(Request $request, $outlet_id, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|max:100,' . Rule::unique('users')->ignore('id', $id),
            'password' => 'max:20',
            're-password' => 'max:20'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password') != ' ' || $request->get('password') != null) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->additional_phone = $request->get('additional_phone');
        $user->address = $request->get('address');
        $user->status = $request->get('status') == 'on' ? 1 : 0;
        if ($request->hasFile('photo')) {
            $user->image = $request->file('photo')
                ->move('uploads/user', str_random(40) . '.' . $request->photo->extension());
        }
        if ($user->save()) {
            return response()->json(['Sells Man Updated', 'Sells man has been updated successfully'], 200);
        }
    }

    /**
     * Delete sells amn by id
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSellsMan($id)
    {
        if(User::destroy($id)){
            return redirect()->back()->with('delete_success','Sells Man deleted successfully');
        }
    }
}
