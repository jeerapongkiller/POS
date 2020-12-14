<?php

namespace App\Http\Controllers;

use App\Model\Outlet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            if (count(auth()->user()->userOutlet) > 1) {
                return view('owner.select-outlet');
            }
            if (auth()->user()->role == 3) {
                $outlet = Outlet::where('owner_id', auth()->user()->id)->first();
                if($outlet){
                    return redirect()->to('/outlet/id=' . $outlet->id . '/dashboard');
                }else{
                    return "We did not find any outlet";
                }
            }elseif(auth()->user()->role == 4){
                return redirect()->to('/outlet/id=' . auth()->user()->sellsManOutlet->outlet_id . '/dashboard');
            }
        }
        return view('home');
    }

    /**
     * Show outlet dashboard if user is outlet owner or sells man
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function outletDash($outlet_id)
    {
        if (auth()->user()->role == 3) {
            return view('owner.dash', [
                'outlet_id' => $outlet_id
            ]);
        } else {
            return view('sellsman.dash',[
                'outlet_id' => $outlet_id
            ]);
        }
        return "Success " . $outlet_id;
    }

    /**
     * Show home page only if application has been installed successfully
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function welcome()
    {
        if(config('app.install') == 1){
            $outlets = Outlet::all();
            return view('website.outlets',[
                'outlets'   =>  $outlets
            ]);
        }else{
            return redirect()->to('/install/database');
        }
    }

    /**
     * Show selected outlet by QR code scan. with outlet all products. customer can also order from there
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function outlet($id)
    {
        $outlet = Outlet::findOrfail($id);
        return view('website.outlet',[
            'outlet'    =>  $outlet
        ]);
    }

    /**
     * Show profile or admin or moderator
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function adminProfile()
    {
        if(auth()->check()){
            return view('profile.profile');
        }else{
            return redirect()->to('/login');
        }
    }

    /**
     * Show profile of outlet owner or sells man
     *
     * @param $outlet_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function profile($outlet_id)
    {
        if(auth()->check()){
            return view('profile.profile',[
                'outlet_id' =>  $outlet_id
            ]);
        }else{
            return redirect()->to('/login');
        }
    }

    /**
     * Update authenticate user profile
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request,$id)
    {
        $user =  User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->additional_phone = $request->get('additional_phone');
        $user->address = $request->get('address');
        if ($request->hasFile('photo')) {
            $user->image = $request->file('photo')
                ->move('uploads/user', str_random(40) . '.' . $request->photo->extension());
        }
        if($user->save()){
            return response()->json(['Profile updated','Profile has been updated successfully'],200);
        }
    }


    /**
     * Change user password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'password'      =>  'required|min:5',
            'new_password'  =>  'required|min:5',
            'confirm'       =>  'required|same:new_password'
        ]);

        if(Hash::check($request->get('password'),auth()->user()->password)){
            $user = User::find(auth()->user()->id);
            $user->password = Hash::make($request->get('new_password'));
            if ($user->save()) {
                return response()->json(['Success','Password has been changed successfully'],200);
            }
        }else{
            return response()->json(['Error','Password not match'],500);
        }
    }




}
